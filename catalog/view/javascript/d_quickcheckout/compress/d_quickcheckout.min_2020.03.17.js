var lang='';
language = jQuery('html').attr('lang');
if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
(function(root, factory) {
    if (typeof exports !== 'undefined') {
        module.exports = factory(require("jquery"), require("underscore"), require("backbone"));
    } else if (typeof define === 'function' && define.amd) {
        define(["jquery", "underscore", "backbone"], factory);
    } else {
        factory(root.$, root._, root.Backbone);
    }
}(this, function($, _, Backbone) {
    'use strict';
    var _delayedTriggers = [],
        nestedChanges;
    Backbone.NestedModel = Backbone.Model.extend({
        get: function(attrStrOrPath) {
            return Backbone.NestedModel.walkThenGet(this.attributes, attrStrOrPath);
        },
        previous: function(attrStrOrPath) {
            return Backbone.NestedModel.walkThenGet(this._previousAttributes, attrStrOrPath);
        },
        has: function(attr) {
            var result = this.get(attr);
            return !(result === null || _.isUndefined(result));
        },
        set: function(key, value, opts) {
            var newAttrs = Backbone.NestedModel.deepClone(this.attributes),
                attrPath, unsetObj, validated;
            if (_.isString(key)) {
                attrPath = Backbone.NestedModel.attrPath(key);
            } else if (_.isArray(key)) {
                attrPath = key;
            }
            if (attrPath) {
                opts = opts || {};
                this._setAttr(newAttrs, attrPath, value, opts);
            } else {
                opts = value || {};
                var attrs = key;
                for (var _attrStr in attrs) {
                    if (attrs.hasOwnProperty(_attrStr)) {
                        this._setAttr(newAttrs, Backbone.NestedModel.attrPath(_attrStr), opts.unset ? void 0 : attrs[_attrStr], opts);
                    }
                }
            }
            nestedChanges = Backbone.NestedModel.__super__.changedAttributes.call(this);
            if (opts.unset && attrPath && attrPath.length === 1) {
                unsetObj = {};
                unsetObj[key] = void 0;
                nestedChanges = _.omit(nestedChanges, _.keys(unsetObj));
                validated = Backbone.NestedModel.__super__.set.call(this, unsetObj, opts);
            } else {
                unsetObj = newAttrs;
                if (opts.unset && attrPath) {
                    opts = _.extend({}, opts);
                    delete opts.unset;
                } else if (opts.unset && _.isObject(key)) {
                    unsetObj = key;
                }
                nestedChanges = _.omit(nestedChanges, _.keys(unsetObj));
                validated = Backbone.NestedModel.__super__.set.call(this, unsetObj, opts);
            }
            if (!validated) {
                this.changed = {};
                nestedChanges = {};
                return false;
            }
            this._runDelayedTriggers();
            return this;
        },
        unset: function(attr, options) {
            return this.set(attr, void 0, _.extend({}, options, {
                unset: true
            }));
        },
        clear: function(options) {
            nestedChanges = {};
            options = options || {};
            var attrs = _.clone(this.attributes);
            if (!options.silent && this.validate && !this.validate(attrs, options)) {
                return false;
            }
            var changed = this.changed = {};
            var model = this;
            var setChanged = function(obj, prefix, options) {
                _.each(obj, function(val, attr) {
                    var changedPath = prefix;
                    if (_.isArray(obj)) {
                        changedPath += '[' + attr + ']';
                    } else if (prefix) {
                        changedPath += '.' + attr;
                    } else {
                        changedPath = attr;
                    }
                    val = obj[attr];
                    if (_.isObject(val)) {
                        setChanged(val, changedPath, options);
                    }
                    if (!options.silent) model._delayedChange(changedPath, null, options);
                    changed[changedPath] = null;
                });
            };
            setChanged(this.attributes, '', options);
            this.attributes = {};
            if (!options.silent) this._delayedTrigger('change');
            this._runDelayedTriggers();
            return this;
        },
        add: function(attrStr, value, opts) {
            var current = this.get(attrStr);
            if (!_.isArray(current)) throw new Error('current value is not an array');
            return this.set(attrStr + '[' + current.length + ']', value, opts);
        },
        remove: function(attrStr, opts) {
            opts = opts || {};
            var attrPath = Backbone.NestedModel.attrPath(attrStr),
                aryPath = _.initial(attrPath),
                val = this.get(aryPath),
                i = _.last(attrPath);
            if (!_.isArray(val)) {
                throw new Error("remove() must be called on a nested array");
            }
            var trigger = !opts.silent && (val.length >= i + 1),
                oldEl = val[i];
            val.splice(i, 1);
            opts.silent = true;
            this.set(aryPath, val, opts);
            if (trigger) {
                attrStr = Backbone.NestedModel.createAttrStr(aryPath);
                this.trigger('remove:' + attrStr, this, oldEl);
                for (var aryCount = aryPath.length; aryCount >= 1; aryCount--) {
                    attrStr = Backbone.NestedModel.createAttrStr(_.first(aryPath, aryCount));
                    this.trigger('change:' + attrStr, this, oldEl);
                }
                this.trigger('change', this, oldEl);
            }
            return this;
        },
        changedAttributes: function(diff) {
            var backboneChanged = Backbone.NestedModel.__super__.changedAttributes.call(this, diff);
            if (_.isObject(backboneChanged)) {
                return _.extend({}, nestedChanges, backboneChanged);
            }
            return false;
        },
        toJSON: function() {
            return Backbone.NestedModel.deepClone(this.attributes);
        },
        _delayedTrigger: function() {
            _delayedTriggers.push(arguments);
        },
        _delayedChange: function(attrStr, newVal, options) {
            this._delayedTrigger('change:' + attrStr, this, newVal, options);
            if (!this.changed) {
                this.changed = {};
            }
            this.changed[attrStr] = newVal;
        },
        _runDelayedTriggers: function() {
            while (_delayedTriggers.length > 0) {
                this.trigger.apply(this, _delayedTriggers.shift());
            }
        },
        _setAttr: function(newAttrs, attrPath, newValue, opts) {
            opts = opts || {};
            var fullPathLength = attrPath.length;
            var model = this;
            Backbone.NestedModel.walkPath(newAttrs, attrPath, function(val, path, next) {
                var attr = _.last(path);
                var attrStr = Backbone.NestedModel.createAttrStr(path);
                var isNewValue = !_.isEqual(val[attr], newValue);
                if (path.length === fullPathLength) {
                    if (opts.unset) {
                        delete val[attr];
                        if (_.isArray(val)) {
                            var parentPath = Backbone.NestedModel.createAttrStr(_.initial(attrPath));
                            model._delayedTrigger('remove:' + parentPath, model, val[attr]);
                        }
                    } else {
                        val[attr] = newValue;
                    }
                    if (!opts.silent && _.isObject(newValue) && isNewValue) {
                        var visited = [];
                        var checkChanges = function(obj, prefix) {
                            if (_.indexOf(visited, obj) > -1) {
                                return;
                            } else {
                                visited.push(obj);
                            }
                            var nestedAttr, nestedVal;
                            for (var a in obj) {
                                if (obj.hasOwnProperty(a)) {
                                    nestedAttr = prefix + '.' + a;
                                    nestedVal = obj[a];
                                    if (!_.isEqual(model.get(nestedAttr), nestedVal)) {
                                        model._delayedChange(nestedAttr, nestedVal, opts);
                                    }
                                    if (_.isObject(nestedVal)) {
                                        checkChanges(nestedVal, nestedAttr);
                                    }
                                }
                            }
                        };
                        checkChanges(newValue, attrStr);
                    }
                } else if (!val[attr]) {
                    if (_.isNumber(next)) {
                        val[attr] = [];
                    } else {
                        val[attr] = {};
                    }
                }
                if (!opts.silent) {
                    if (path.length > 1 && isNewValue) {
                        model._delayedChange(attrStr, val[attr], opts);
                    }
                    if (_.isArray(val[attr])) {
                        model._delayedTrigger('add:' + attrStr, model, val[attr]);
                    }
                }
            });
        }
    }, {
        attrPath: function(attrStrOrPath) {
            var path;
            if (_.isString(attrStrOrPath)) {
                path = (attrStrOrPath === '') ? [''] : attrStrOrPath.match(/[^\.\[\]]+/g);
                path = _.map(path, function(val) {
                    return val.match(/^\d+$/) ? parseInt(val, 10) : val;
                });
            } else {
                path = attrStrOrPath;
            }
            return path;
        },
        createAttrStr: function(attrPath) {
            var attrStr = attrPath[0];
            _.each(_.rest(attrPath), function(attr) {
                attrStr += _.isNumber(attr) ? ('[' + attr + ']') : ('.' + attr);
            });
            return attrStr;
        },
        deepClone: function(obj) {
            return $.extend(true, {}, obj);
        },
        walkPath: function(obj, attrPath, callback, scope) {
            var val = obj,
                childAttr;
            for (var i = 0; i < attrPath.length; i++) {
                callback.call(scope || this, val, attrPath.slice(0, i + 1), attrPath[i + 1]);
                childAttr = attrPath[i];
                val = val[childAttr];
                if (!val) break;
            }
        },
        walkThenGet: function(attributes, attrStrOrPath) {
            var attrPath = Backbone.NestedModel.attrPath(attrStrOrPath),
                result;
            Backbone.NestedModel.walkPath(attributes, attrPath, function(val, path) {
                var attr = _.last(path);
                if (path.length === attrPath.length) {
                    result = val[attr];
                }
            });
            return result;
        }
    });
    return Backbone;
}));
if (!window.console) window.console = {};
if (!window.console.log) window.console.log = function() {};
var qc = qc || {};
var focused = window;
qc.event = _.extend({}, Backbone.Events);
qc.statistic = qc.statistic || {};
$.fn.serializeObject = function() {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function preloaderStart() {
    $('#qc_confirm_order').prop('disabled', true);
    $('.preloader').delay(500).fadeIn(300);
}

function preloaderStop() {
    $('#qc_confirm_order').prop('disabled', false);
    $('.preloader').stop(true, true).fadeOut(300);
}

function sformat(pattern, address) {
    var result = pattern;
    result = result.replace(/\{firstname\}/g, '<strong>' + address.firstname);
    result = result.replace(/\{lastname\}/g, address.lastname + '</strong>');
    result = result.replace(/\{company\}/g, address.company);
    result = result.replace(/\{address_1\}/g, address.address_1);
    result = result.replace(/\{address_2\}/g, address.address_2);
    result = result.replace(/\{city\}/g, address.city);
    result = result.replace(/\{zone\}/g, address.zone);
    result = result.replace(/\{country\}/g, address.country);
    result = result.replace(/\{postcode\}/g, address.postcode);
    result = result.replace(/\{zone_code\}/g, address.zone_code);
    result = result.replace(/^\s*\n/gm, "");
    result = result.replace(/^\s+|\s+$/g, "");
    return result;
}
if (typeof $().modal != 'function') {
    ! function($) {
        "use strict";
        var Modal = function(element, options) {
            this.options = options
            this.$element = $(element).delegate('[data-dismiss="modal"]', 'click.dismiss.modal', $.proxy(this.hide, this))
            this.options.remote && this.$element.find('.modal-body').load(this.options.remote)
        }
        Modal.prototype = {
            constructor: Modal,
            toggle: function() {
                return this[!this.isShown ? 'show' : 'hide']()
            },
            show: function() {
                var that = this,
                    e = $.Event('show')
                this.$element.trigger(e)
                if (this.isShown || e.isDefaultPrevented()) return
                $('body').addClass('modal-open')
                this.isShown = true
                this.escape()
                this.backdrop(function() {
                    var transition = $.support.transition && that.$element.hasClass('fade')
                    if (!that.$element.parent().length) {
                        that.$element.appendTo(document.body)
                    }
                    that.$element.show()
                    if (transition) {
                        that.$element[0].offsetWidth
                    }
                    that.$element.addClass('in').attr('aria-hidden', false).focus()
                    that.enforceFocus()
                    transition ? that.$element.one($.support.transition.end, function() {
                        that.$element.trigger('shown')
                    }) : that.$element.trigger('shown')
                })
            },
            hide: function(e) {
                e && e.preventDefault()
                var that = this
                e = $.Event('hide')
                this.$element.trigger(e)
                if (!this.isShown || e.isDefaultPrevented()) return
                this.isShown = false
                $('body').removeClass('modal-open')
                this.escape()
                $(document).off('focusin.modal')
                this.$element.removeClass('in').attr('aria-hidden', true)
                $.support.transition && this.$element.hasClass('fade') ? this.hideWithTransition() : this.hideModal()
            },
            enforceFocus: function() {
                var that = this
                $(document).on('focusin.modal', function(e) {
                    if (that.$element[0] !== e.target && !that.$element.has(e.target).length) {
                        that.$element.focus()
                    }
                })
            },
            escape: function() {
                var that = this
                if (this.isShown && this.options.keyboard) {
                    this.$element.on('keyup.dismiss.modal', function(e) {
                        e.which == 27 && that.hide()
                    })
                } else if (!this.isShown) {
                    this.$element.off('keyup.dismiss.modal')
                }
            },
            hideWithTransition: function() {
                var that = this,
                    timeout = setTimeout(function() {
                        that.$element.off($.support.transition.end)
                        that.hideModal()
                    }, 500)
                this.$element.one($.support.transition.end, function() {
                    clearTimeout(timeout)
                    that.hideModal()
                })
            },
            hideModal: function(that) {
                this.$element.hide().trigger('hidden')
                this.backdrop()
            },
            removeBackdrop: function() {
                this.$backdrop.remove()
                this.$backdrop = null
            },
            backdrop: function(callback) {
                var that = this,
                    animate = this.$element.hasClass('fade') ? 'fade' : ''
                if (this.isShown && this.options.backdrop) {
                    var doAnimate = $.support.transition && animate
                    this.$backdrop = $('<div class="modal-backdrop ' + animate + '" />').appendTo(document.body)
                    if (this.options.backdrop != 'static') {
                        this.$backdrop.click($.proxy(this.hide, this))
                    }
                    if (doAnimate) this.$backdrop[0].offsetWidth
                    this.$backdrop.addClass('in')
                    doAnimate ? this.$backdrop.one($.support.transition.end, callback) : callback()
                } else if (!this.isShown && this.$backdrop) {
                    this.$backdrop.removeClass('in')
                    $.support.transition && this.$element.hasClass('fade') ? this.$backdrop.one($.support.transition.end, $.proxy(this.removeBackdrop, this)) : this.removeBackdrop()
                } else if (callback) {
                    callback()
                }
            }
        }
        $.fn.modal = function(option) {
            return this.each(function() {
                var $this = $(this),
                    data = $this.data('modal'),
                    options = $.extend({}, $.fn.modal.defaults, $this.data(), typeof option == 'object' && option)
                if (!data) $this.data('modal', (data = new Modal(this, options)))
                if (typeof option == 'string') data[option]()
                else if (options.show) data.show()
            })
        }
        $.fn.modal.defaults = {
            backdrop: true,
            keyboard: true,
            show: true
        }
        $.fn.modal.Constructor = Modal
        $(function() {
            $('body').on('click.modal.data-api', '[data-toggle="modal"]', function(e) {
                var $this = $(this),
                    href = $this.attr('href'),
                    $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, ''))),
                    option = $target.data('modal') ? 'toggle' : $.extend({
                        remote: !/#/.test(href) && href
                    }, $target.data(), $this.data())
                e.preventDefault()
                $target.modal(option).one('hide', function() {
                    $this.focus()
                })
            })
        })
    }(window.jQuery);
}
if (typeof $().tooltip != 'function') {
    + function($) {
        'use strict';
        var Tooltip = function(element, options) {
            this.type = null
            this.options = null
            this.enabled = null
            this.timeout = null
            this.hoverState = null
            this.$element = null
            this.inState = null
            this.init('tooltip', element, options)
        }
        Tooltip.VERSION = '3.3.5'
        Tooltip.TRANSITION_DURATION = 150
        Tooltip.DEFAULTS = {
            animation: true,
            placement: 'top',
            selector: false,
            template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
            trigger: 'hover focus',
            title: '',
            delay: 0,
            html: false,
            container: false,
            viewport: {
                selector: 'body',
                padding: 0
            }
        }
        Tooltip.prototype.init = function(type, element, options) {
            this.enabled = true
            this.type = type
            this.$element = $(element)
            this.options = this.getOptions(options)
            this.$viewport = this.options.viewport && $($.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : (this.options.viewport.selector || this.options.viewport))
            this.inState = {
                click: false,
                hover: false,
                focus: false
            }
            if (this.$element[0] instanceof document.constructor && !this.options.selector) {
                throw new Error('`selector` option must be specified when initializing ' + this.type + ' on the window.document object!')
            }
            var triggers = this.options.trigger.split(' ')
            for (var i = triggers.length; i--;) {
                var trigger = triggers[i]
                if (trigger == 'click') {
                    this.$element.on('click.' + this.type, this.options.selector, $.proxy(this.toggle, this))
                } else if (trigger != 'manual') {
                    var eventIn = trigger == 'hover' ? 'mouseenter' : 'focusin'
                    var eventOut = trigger == 'hover' ? 'mouseleave' : 'focusout'
                    this.$element.on(eventIn + '.' + this.type, this.options.selector, $.proxy(this.enter, this))
                    this.$element.on(eventOut + '.' + this.type, this.options.selector, $.proxy(this.leave, this))
                }
            }
            this.options.selector ? (this._options = $.extend({}, this.options, {
                trigger: 'manual',
                selector: ''
            })) : this.fixTitle()
        }
        Tooltip.prototype.getDefaults = function() {
            return Tooltip.DEFAULTS
        }
        Tooltip.prototype.getOptions = function(options) {
            options = $.extend({}, this.getDefaults(), this.$element.data(), options)
            if (options.delay && typeof options.delay == 'number') {
                options.delay = {
                    show: options.delay,
                    hide: options.delay
                }
            }
            return options
        }
        Tooltip.prototype.getDelegateOptions = function() {
            var options = {}
            var defaults = this.getDefaults()
            this._options && $.each(this._options, function(key, value) {
                if (defaults[key] != value) options[key] = value
            })
            return options
        }
        Tooltip.prototype.enter = function(obj) {
            var self = obj instanceof this.constructor ? obj : $(obj.currentTarget).data('bs.' + this.type)
            if (!self) {
                self = new this.constructor(obj.currentTarget, this.getDelegateOptions())
                $(obj.currentTarget).data('bs.' + this.type, self)
            }
            if (obj instanceof $.Event) {
                self.inState[obj.type == 'focusin' ? 'focus' : 'hover'] = true
            }
            if (self.tip().hasClass('in') || self.hoverState == 'in') {
                self.hoverState = 'in'
                return
            }
            clearTimeout(self.timeout)
            self.hoverState = 'in'
            if (!self.options.delay || !self.options.delay.show) return self.show()
            self.timeout = setTimeout(function() {
                if (self.hoverState == 'in') self.show()
            }, self.options.delay.show)
        }
        Tooltip.prototype.isInStateTrue = function() {
            for (var key in this.inState) {
                if (this.inState[key]) return true
            }
            return false
        }
        Tooltip.prototype.leave = function(obj) {
            var self = obj instanceof this.constructor ? obj : $(obj.currentTarget).data('bs.' + this.type)
            if (!self) {
                self = new this.constructor(obj.currentTarget, this.getDelegateOptions())
                $(obj.currentTarget).data('bs.' + this.type, self)
            }
            if (obj instanceof $.Event) {
                self.inState[obj.type == 'focusout' ? 'focus' : 'hover'] = false
            }
            if (self.isInStateTrue()) return
            clearTimeout(self.timeout)
            self.hoverState = 'out'
            if (!self.options.delay || !self.options.delay.hide) return self.hide()
            self.timeout = setTimeout(function() {
                if (self.hoverState == 'out') self.hide()
            }, self.options.delay.hide)
        }
        Tooltip.prototype.show = function() {
            var e = $.Event('show.bs.' + this.type)
            if (this.hasContent() && this.enabled) {
                this.$element.trigger(e)
                var inDom = $.contains(this.$element[0].ownerDocument.documentElement, this.$element[0])
                if (e.isDefaultPrevented() || !inDom) return
                var that = this
                var $tip = this.tip()
                var tipId = this.getUID(this.type)
                this.setContent()
                $tip.attr('id', tipId)
                this.$element.attr('aria-describedby', tipId)
                if (this.options.animation) $tip.addClass('fade')
                var placement = typeof this.options.placement == 'function' ? this.options.placement.call(this, $tip[0], this.$element[0]) : this.options.placement
                var autoToken = /\s?auto?\s?/i
                var autoPlace = autoToken.test(placement)
                if (autoPlace) placement = placement.replace(autoToken, '') || 'top'
                $tip.detach().css({
                    top: 0,
                    left: 0,
                    display: 'block'
                }).addClass(placement).data('bs.' + this.type, this)
                this.options.container ? $tip.appendTo(this.options.container) : $tip.insertAfter(this.$element)
                this.$element.trigger('inserted.bs.' + this.type)
                var pos = this.getPosition()
                var actualWidth = $tip[0].offsetWidth
                var actualHeight = $tip[0].offsetHeight
                if (autoPlace) {
                    var orgPlacement = placement
                    var viewportDim = this.getPosition(this.$viewport)
                    placement = placement == 'bottom' && pos.bottom + actualHeight > viewportDim.bottom ? 'top' : placement == 'top' && pos.top - actualHeight < viewportDim.top ? 'bottom' : placement == 'right' && pos.right + actualWidth > viewportDim.width ? 'left' : placement == 'left' && pos.left - actualWidth < viewportDim.left ? 'right' : placement
                    $tip.removeClass(orgPlacement).addClass(placement)
                }
                var calculatedOffset = this.getCalculatedOffset(placement, pos, actualWidth, actualHeight)
                this.applyPlacement(calculatedOffset, placement)
                var complete = function() {
                    var prevHoverState = that.hoverState
                    that.$element.trigger('shown.bs.' + that.type)
                    that.hoverState = null
                    if (prevHoverState == 'out') that.leave(that)
                }
                $.support.transition && this.$tip.hasClass('fade') ? $tip.one('bsTransitionEnd', complete).emulateTransitionEnd(Tooltip.TRANSITION_DURATION) : complete()
            }
        }
        Tooltip.prototype.applyPlacement = function(offset, placement) {
            var $tip = this.tip()
            var width = $tip[0].offsetWidth
            var height = $tip[0].offsetHeight
            var marginTop = parseInt($tip.css('margin-top'), 10)
            var marginLeft = parseInt($tip.css('margin-left'), 10)
            if (isNaN(marginTop)) marginTop = 0
            if (isNaN(marginLeft)) marginLeft = 0
            offset.top += marginTop
            offset.left += marginLeft
            $.offset.setOffset($tip[0], $.extend({
                using: function(props) {
                    $tip.css({
                        top: Math.round(props.top),
                        left: Math.round(props.left)
                    })
                }
            }, offset), 0)
            $tip.addClass('in')
            var actualWidth = $tip[0].offsetWidth
            var actualHeight = $tip[0].offsetHeight
            if (placement == 'top' && actualHeight != height) {
                offset.top = offset.top + height - actualHeight
            }
            var delta = this.getViewportAdjustedDelta(placement, offset, actualWidth, actualHeight)
            if (delta.left) offset.left += delta.left
            else offset.top += delta.top
            var isVertical = /top|bottom/.test(placement)
            var arrowDelta = isVertical ? delta.left * 2 - width + actualWidth : delta.top * 2 - height + actualHeight
            var arrowOffsetPosition = isVertical ? 'offsetWidth' : 'offsetHeight'
            $tip.offset(offset)
            this.replaceArrow(arrowDelta, $tip[0][arrowOffsetPosition], isVertical)
        }
        Tooltip.prototype.replaceArrow = function(delta, dimension, isVertical) {
            this.arrow().css(isVertical ? 'left' : 'top', 50 * (1 - delta / dimension) + '%').css(isVertical ? 'top' : 'left', '')
        }
        Tooltip.prototype.setContent = function() {
            var $tip = this.tip()
            var title = this.getTitle()
            $tip.find('.tooltip-inner')[this.options.html ? 'html' : 'text'](title)
            $tip.removeClass('fade in top bottom left right')
        }
        Tooltip.prototype.hide = function(callback) {
            var that = this
            var $tip = $(this.$tip)
            var e = $.Event('hide.bs.' + this.type)

            function complete() {
                if (that.hoverState != 'in') $tip.detach()
                that.$element.removeAttr('aria-describedby').trigger('hidden.bs.' + that.type)
                callback && callback()
            }
            this.$element.trigger(e)
            if (e.isDefaultPrevented()) return
            $tip.removeClass('in')
            $.support.transition && $tip.hasClass('fade') ? $tip.one('bsTransitionEnd', complete).emulateTransitionEnd(Tooltip.TRANSITION_DURATION) : complete()
            this.hoverState = null
            return this
        }
        Tooltip.prototype.fixTitle = function() {
            var $e = this.$element
            if ($e.attr('title') || typeof $e.attr('data-original-title') != 'string') {
                $e.attr('data-original-title', $e.attr('title') || '').attr('title', '')
            }
        }
        Tooltip.prototype.hasContent = function() {
            return this.getTitle()
        }
        Tooltip.prototype.getPosition = function($element) {
            $element = $element || this.$element
            var el = $element[0]
            var isBody = el.tagName == 'BODY'
            var elRect = el.getBoundingClientRect()
            if (elRect.width == null) {
                elRect = $.extend({}, elRect, {
                    width: elRect.right - elRect.left,
                    height: elRect.bottom - elRect.top
                })
            }
            var elOffset = isBody ? {
                top: 0,
                left: 0
            } : $element.offset()
            var scroll = {
                scroll: isBody ? document.documentElement.scrollTop || document.body.scrollTop : $element.scrollTop()
            }
            var outerDims = isBody ? {
                width: $(window).width(),
                height: $(window).height()
            } : null
            return $.extend({}, elRect, scroll, outerDims, elOffset)
        }
        Tooltip.prototype.getCalculatedOffset = function(placement, pos, actualWidth, actualHeight) {
            return placement == 'bottom' ? {
                top: pos.top + pos.height,
                left: pos.left + pos.width / 2 - actualWidth / 2
            } : placement == 'top' ? {
                top: pos.top - actualHeight,
                left: pos.left + pos.width / 2 - actualWidth / 2
            } : placement == 'left' ? {
                top: pos.top + pos.height / 2 - actualHeight / 2,
                left: pos.left - actualWidth
            } : {
                top: pos.top + pos.height / 2 - actualHeight / 2,
                left: pos.left + pos.width
            }
        }
        Tooltip.prototype.getViewportAdjustedDelta = function(placement, pos, actualWidth, actualHeight) {
            var delta = {
                top: 0,
                left: 0
            }
            if (!this.$viewport) return delta
            var viewportPadding = this.options.viewport && this.options.viewport.padding || 0
            var viewportDimensions = this.getPosition(this.$viewport)
            if (/right|left/.test(placement)) {
                var topEdgeOffset = pos.top - viewportPadding - viewportDimensions.scroll
                var bottomEdgeOffset = pos.top + viewportPadding - viewportDimensions.scroll + actualHeight
                if (topEdgeOffset < viewportDimensions.top) {
                    delta.top = viewportDimensions.top - topEdgeOffset
                } else if (bottomEdgeOffset > viewportDimensions.top + viewportDimensions.height) {
                    delta.top = viewportDimensions.top + viewportDimensions.height - bottomEdgeOffset
                }
            } else {
                var leftEdgeOffset = pos.left - viewportPadding
                var rightEdgeOffset = pos.left + viewportPadding + actualWidth
                if (leftEdgeOffset < viewportDimensions.left) {
                    delta.left = viewportDimensions.left - leftEdgeOffset
                } else if (rightEdgeOffset > viewportDimensions.right) {
                    delta.left = viewportDimensions.left + viewportDimensions.width - rightEdgeOffset
                }
            }
            return delta
        }
        Tooltip.prototype.getTitle = function() {
            var title
            var $e = this.$element
            var o = this.options
            title = $e.attr('data-original-title') || (typeof o.title == 'function' ? o.title.call($e[0]) : o.title)
            return title
        }
        Tooltip.prototype.getUID = function(prefix) {
            do prefix += ~~(Math.random() * 1000000)
            while (document.getElementById(prefix))
            return prefix
        }
        Tooltip.prototype.tip = function() {
            if (!this.$tip) {
                this.$tip = $(this.options.template)
                if (this.$tip.length != 1) {
                    throw new Error(this.type + ' `template` option must consist of exactly 1 top-level element!')
                }
            }
            return this.$tip
        }
        Tooltip.prototype.arrow = function() {
            return (this.$arrow = this.$arrow || this.tip().find('.tooltip-arrow'))
        }
        Tooltip.prototype.enable = function() {
            this.enabled = true
        }
        Tooltip.prototype.disable = function() {
            this.enabled = false
        }
        Tooltip.prototype.toggleEnabled = function() {
            this.enabled = !this.enabled
        }
        Tooltip.prototype.toggle = function(e) {
            var self = this
            if (e) {
                self = $(e.currentTarget).data('bs.' + this.type)
                if (!self) {
                    self = new this.constructor(e.currentTarget, this.getDelegateOptions())
                    $(e.currentTarget).data('bs.' + this.type, self)
                }
            }
            if (e) {
                self.inState.click = !self.inState.click
                if (self.isInStateTrue()) self.enter(self)
                else self.leave(self)
            } else {
                self.tip().hasClass('in') ? self.leave(self) : self.enter(self)
            }
        }
        Tooltip.prototype.destroy = function() {
            var that = this
            clearTimeout(this.timeout)
            this.hide(function() {
                that.$element.off('.' + that.type).removeData('bs.' + that.type)
                if (that.$tip) {
                    that.$tip.detach()
                }
                that.$tip = null
                that.$arrow = null
                that.$viewport = null
            })
        }

        function Plugin(option) {
            return this.each(function() {
                var $this = $(this)
                var data = $this.data('bs.tooltip')
                var options = typeof option == 'object' && option
                if (!data && /destroy|hide/.test(option)) return
                if (!data) $this.data('bs.tooltip', (data = new Tooltip(this, options)))
                if (typeof option == 'string') data[option]()
            })
        }
        var old = $.fn.tooltip
        $.fn.tooltip = Plugin
        $.fn.tooltip.Constructor = Tooltip
        $.fn.tooltip.noConflict = function() {
            $.fn.tooltip = old
            return this
        }
    }(jQuery);
}
qc.Model = Backbone.NestedModel.extend({
    defaults: '',
    initialize: function() {
        console.log("Engine Model start");
    },
    isJson: function(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    },
    updateForm: function(data) {
        preloaderStop();

        /*if (parseInt(config.general.debug)) {
            console.log(data);
        }*/
        qc.event.trigger('update', data);
        if (data.redirect) {
            window.location = data.redirect;
        }
        if (data.account) {
            qc.event.trigger('changeAccount', data.account);
        }
        if (data.login_error) {
            qc.login.set('error', data.login_error);
        }
        if (data.error) {
            alert(data.error);
        }
        getsel();
        getsel1();
        replace_totals();
        //?????????????????????? ?????? ??????????????
        oncomplete();
    },
});
qc.View = Backbone.View.extend({
    defaults: '',
    initialize: function() {
        console.log("Engine View start");
    },
    focusedElementId: $(':focus').attr('id'),
    events: {
        'focus input': "updateFocus"
    },
    changeAccount: function(account) {
        if (this.model.get('account') !== account) {
            this.model.changeAccount(account);
            this.render();
        }
    },
    isJson: function(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    },
});
qc.Login = qc.Model.extend({
    defaults: '',
    initialize: function() {
        this.set('config', config.account[this.get('account')].login);
    },
    changeAccount: function(account) {
        this.set('account', account);
    },
    loginAccount: function(json) {
        this.set(json);
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/login/loginAccount'+lang, json, function(data) {
            if (parseInt(config.general.login_refresh)) {
                window.location.reload();
            } else {
                if (data.login_error) {
                    that.updateForm(data);
                } else {
                    $.post('index.php?route=d_quickcheckout/login/updateAll'+lang, json, function(data) {
                        that.updateForm(data);
                    }, 'json');
                }
            }
        }, 'json');
    },
    updateAccount: function(account) {
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        this.set('account', account);
        this.set('config', config.account[this.get('account')].login);
        var json = this.toJSON();
        var that = this;
        $.post('index.php?route=d_quickcheckout/login/updateAccount'+lang, {
            'account': json.account
        }, function(data) {
            that.updateForm(data);
        }, 'json');
    },
});
qc.LoginView = qc.View.extend({
    initialize: function(e) {
        Backbone.View.prototype.initialize.call(this);
        this.template = e.template;
        qc.event.bind("changeAccount", this.changeAccount, this);
        this.model.on("change", this.render, this);
        this.render();
    },
    events: {
        'change input[name=account]': 'updateAccount',
        'click button#button_login': 'loginAccount'
    },
    template: '',
    render: function() {
        this.focusedElementId = $(':focus').attr('id');
        $(this.el).html(this.template({
            'model': this.model.toJSON()
        }));
        $('body').on('click', function() {
            $('#login_button_popup').removeClass('active');
        })
        $('#' + this.focusedElementId).focus();
    },
    changeAccount: function(account) {
        if (this.model.get('account') !== account) {
            this.model.changeAccount(account);
            this.render();
        }
    },
    updateAccount: function(e) {
        this.model.updateAccount(e.currentTarget.value);
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'click', e.currentTarget.name);
        }
        preloaderStart();
    },
    loginAccount: function(e) {
        $('#login_model').modal('hide');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').fadeOut();
        var json = $('#login_form').serializeObject();
        this.model.loginAccount(json);
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'click', 'login');
        }
        preloaderStart();
        return false;
    },
});
qc.FieldView = qc.View.extend({
    initialize: function(e) {
        this.template = e.template;
    },
    events: {
        'change input[type=tel].not-required': 'updateField',
        'change input[type=tel].required': 'validateField',
        'change input[type=text].not-required': 'updateField',
        'change input[type=text].required': 'validateField',
        'change input[type=email].not-required': 'updateField',
        'change input[type=email].required': 'validateField',
        'change input[type=password].not-required': 'updateField',
        'change input[type=password].required': 'validateField',
        'change input[type=datetime].not-required': 'updateField',
        'change input[type=datetime].required': 'validateField',
        'change input[type=date].not-required': 'updateField',
        'change input[type=date].required': 'validateField',
        'change input[type=time].not-required': 'updateField',
        'change input[type=time].required': 'validateField',
        'change input[type=radio].not-required': 'updateField',
        'change input[type=radio].required': 'validateField',
        'change input[type=checkbox].not-required': 'updateCheckbox',
        'change input[type=checkbox].required': 'validateCheckbox',
        'change textarea': 'validateField',
        'change select': 'validateField',
    },
    template: '',
    render: function() {
        //console.log('field:render');
        this.setValidate();
        $(this.el).html(this.template({
            'model': this.model.toJSON()
        }));
        this.setDateTime();
        $('.sort-item').tsort({
            attr: 'data-sort'
        });
        $('.qc-mask').each(function() {
            $(this).mask($(this).attr('qc-mask'));
        })
    },
    setDateTime: function() {
        var that = this;
        $('.date', this.el).datetimepicker({
            pickTime: false,
            dateFormat: "mm/DD/YYYY",
        })
        $('.time', this.el).datetimepicker({
            pickDate: false,
            dateFormat: "mm/DD/YYYY",
        })
        $('.datetime', this.el).datetimepicker({
            pickDate: true,
            pickTime: true,
            dateFormat: "mm/DD/YYYY",
        })
    },
    setValidate: function() {
        jQuery.validator.addMethod("validTel", function(value, element) {
            if(value.search('_') != -1){
                return false;    
            } else {
                return this.optional(element) || (parseFloat(value) > 0);
            }
        }, jQuery.validator.messages.required);

        $(this.el).validate({
            submitHandler: function(form) {},
            errorPlacement: function(error, element) {
                //error.appendTo(element.closest('div[class^="col-"]'));
                error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element.form).find("#" + element.id + "_input").addClass("has-error");

            },
            unhighlight: function(element, errorClass, validClass) {
                $(element.form).find("#" + element.id + "_input").removeClass("has-error");
            },
            errorClass: "text-danger",
            errorElement: "div",
            rules:{
                "payment_address.telephone":{ validTel : true },
            },
        });
    },
    validateField: function(e) {
        if ($(e.currentTarget).valid()) {
            this.updateField(e);
        } else {
            if (parseInt(config.general.analytics_event)) {
                ga('send', 'event', config.name, 'error', e.currentTarget.name + '.' + e.currentTarget.value);
            }
            preloaderStop();
        }
    },
    updateField: function(e) {
        this.model.updateField(e.currentTarget.name, e.currentTarget.value);
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'update', e.currentTarget.name);
        }
        preloaderStart();
    },
    validateCheckbox: function(e) {
        if ($(e.currentTarget).valid()) {
            this.updateCheckbox(e);
        } else {
            if (parseInt(config.general.analytics_event)) {
                ga('send', 'event', config.name, 'error', e.currentTarget.name + '.' + e.currentTarget.value);
            }
            preloaderStop();
        }
    },
    updateCheckbox: function(e) {
        if ($(e.currentTarget).is(":checked")) {
            this.model.updateField(e.currentTarget.name, e.currentTarget.value);
        } else {
            this.model.updateField(e.currentTarget.name, 0);
        }
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'update', e.currentTarget.name);
        }
        preloaderStart();
    },
});
qc.PaymentAddress = qc.Model.extend({
    defaults: {
        'payment_address': '',
        'config': '',
        'account': '',
        'addresses': '',
    },
    initialize: function() {
        this.set('config', config.account[this.get('account')].payment_address);
    },
    changeAccount: function(account) {
        this.set('account', account);
        this.set('config', config.account[this.get('account')].payment_address);
    },
    changeAddress: function(address_id) {
        this.set('payment_address.address_id', address_id);
        if (address_id != 'new') {
            this.set('payment_address.shipping_address', 0);
        }
        var json = this.toJSON();
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/payment_address/update'+lang, {
            'payment_address': json.payment_address
        }, function(data) {
            that.updateForm(data);
        }, 'json');
    },
    updateField: function(name, value) {
        this.set(name, value);
        var that = this;
        var json = this.toJSON();
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/payment_address/update'+lang, {
            'payment_address': json.payment_address
        }, function(data) {
            that.updateForm(data);
        }, 'json');
    },
});
qc.PaymentAddressView = qc.View.extend({
    initialize: function(e) {
        this.template = e.template;
        qc.event.bind("update", this.update, this);
        this.render();
    },
    events: {
        //'change input[type=radio].payment-address': 'changeAddress',
        'change select.country_id': 'changeCountry',
        //'change #payment_address_customer_group_id_input input': 'changeCustomer',
    },
    template: '',
    fields: '',
    changeAccount: function(account) {
        if (this.model.get('account') !== account) {
            this.model.changeAccount(account);
            this.render();
        }
    },
    changeAddress: function(e) {
        this.model.changeAddress(e.currentTarget.value);
        this.render();
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'update', 'payment_address.changeAddress');
        }
        preloaderStart();
    },
    changeCountry: function(e) {
        this.model.set('shipping_address.zone_id', 0);
        this.setZone(e.currentTarget.value);
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'update', 'payment_address.changeCountry');
        }
        preloaderStart();
    },
    setZone: function(country_id) {
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/field/getZone'+lang, {
            country_id: country_id
        }, function(data) {
            that.model.set('config.fields.zone_id.options', data);
            that.render();
        }, 'json');
    },
    /*changeCustomer: function(t) {
        //val =$(this).attr('value');
        //console.log(val);
        //console.log(this.fields);
       
    },*/
    update: function(data) {
        if (data.payment_address) {
            this.model.set('payment_address', data.payment_address);
        }
        if (typeof(data.shipping_required) !== 'undefined') {
            this.model.set('shipping_required', data.shipping_required);
            this.render();
        }
        if (data.addresses) {
            this.model.set('addresses', data.addresses);
            this.render();
        }
        if (data.account && data.account !== this.model.get('account')) {
            this.changeAccount(data.account);
            this.setZone(this.model.get('payment_address.country_id'));
        }
        if (data.payment_address_refresh) {
            this.render();
        }
    },
    shipping_required: function() {
        if (this.model.get('shipping_required')) {
            $('#payment_address_shipping_address_input').show();
        } else {
            $('#payment_address_shipping_address_input').hide();
        }
    },
    render: function() {
        this.focusedElementId = $(':focus').attr('id');
        //console.log('payment_address:render');
        $(this.el).html(this.template({
            'model': this.model.toJSON()
        }));
        this.fields = $.extend(true, {}, new qc.FieldView({
            el: $("#payment_address_form"),
            model: this.model,
            template: _.template($("#field_template").html())
        }));
        this.fields.render();
        this.shipping_required();
        $('#' + this.focusedElementId).focus();

        $('#payment_address_telephone').mask("+38(999) 999-99-99",{autoclear: false});
        //$('#payment_address_telephone').caret(0,0);
        /*$('#payment_address_telephone').on('click', function () {
            console.log($(this).val());
            if ($(this).val() === '+38(___) ___-___-___') {
                $(this).get(0).setSelectionRange(0, 0);
                return false;
            }
        });
        */
    },
});
qc.ShippingAddress = qc.Model.extend({
    defaults: {
        'shipping_address': '',
        'config': '',
        'account': '',
        'addresses': '',
        'show_shipping_address': '',
    },
    initialize: function() {
        this.set('config', config.account[this.get('account')].shipping_address);
    },
    changeAccount: function(account) {
        this.set('account', account);
        this.set('config', config.account[this.get('account')].shipping_address);
    },
    changeAddress: function(address_id) {
        this.set('shipping_address.address_id', address_id);
        var json = this.toJSON();
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/shipping_address/update'+lang, {
            'shipping_address': json.shipping_address
        }, function(data) {
            that.updateForm(data);
        }, 'json');
    },
    updateField: function(name, value) {
        this.set(name, value);
        var json = this.toJSON();
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/shipping_address/update'+lang, {
            'shipping_address': json.shipping_address
        }, function(data) {
            that.updateForm(data);
        }, 'json');
    },
});
qc.ShippingAddressView = qc.View.extend({
    initialize: function(e) {
        this.template = e.template;
        qc.event.bind("update", this.update, this);
        this.render();
    },
    events: {
        'change input[type=radio].shipping-address': 'changeAddress',
        'change select.country_id': 'changeCountry',
    },
    template: '',
    fields: '',
    changeAccount: function(account) {
        if (this.model.get('account') !== account) {
            this.model.changeAccount(account);
            this.render();
        }
    },
    changeAddress: function(e) {
        this.model.changeAddress(e.currentTarget.value);
        this.render();
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'update', 'shipping_address.changeAddress');
        }
        preloaderStart();
    },
    changeCountry: function(e) {
        this.model.set('shipping_address.zone_id', 0);
        this.setZone(e.currentTarget.value);
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'update', 'shipping_address.changeCountry');
        }
        preloaderStart();
    },
    setZone: function(country_id) {
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/field/getZone'+lang, {
            country_id: country_id
        }, function(data) {
            that.model.set('config.fields.zone_id.options', data);
            that.render();
        }, 'json');
    },
    update: function(data) {
        if (data.shipping_address) {
            this.model.set('shipping_address', data.shipping_address);
        }
        if (typeof(data.show_shipping_address) !== 'undefined' && data.show_shipping_address !== this.model.get('show_shipping_address')) {
            this.model.set('show_shipping_address', data.show_shipping_address);
            this.render();
        }
        if (data.addresses) {
            this.model.set('addresses', data.addresses);
            this.render();
        }
        if (typeof(data.account) !== 'undefined' && data.account !== this.model.get('account')) {
            this.changeAccount(data.account);
            this.setZone(this.model.get('shipping_address.country_id'));
        }
        if (data.shipping_address_refresh) {
            this.render();
        }
    },
    render: function() {
        this.focusedElementId = $(':focus').attr('id');
        //console.log('shipping_address:render');
        $(this.el).html(this.template({
            'model': this.model.toJSON()
        }));
        this.fields = $.extend(true, {}, new qc.FieldView({
            el: $("#shipping_address_form"),
            model: this.model,
            template: _.template($("#field_template").html())
        }));
        this.fields.render();
        $('#' + this.focusedElementId).focus();
    },
});
qc.ShippingMethod = qc.Model.extend({
    defaults: '',
    initialize: function() {
        this.set('config', config.account[this.get('account')].shipping_method);
    },
    changeAccount: function(account) {
        this.set('account', account);
        this.set('config', config.account[this.get('account')].shipping_method);
    },
    update: function(json) {
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/shipping_method/update'+lang, json, function(data) {
            that.updateForm(data);
        }, 'json');
    },
});
qc.ShippingMethodView = qc.View.extend({
    initialize: function(e) {
        this.template = e.template;
        qc.event.bind("update", this.update, this);
        this.model.on("change", this.render, this);
        this.render();
    },
    events: {
        'change input[type=radio]': 'updateShippingMethod',
        'change select': 'updateShippingMethod',
    },
    template: '',
    updateShippingMethod: function(e) { 
        this.model.update($('#shipping_method_form').serializeArray());
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'update', 'shipping_method.' + e.currentTarget.value);
        }
        preloaderStart();
    },
    render: function() {        
        this.focusedElementId = $(':focus').attr('id');
        $(this.el).html(this.template({
            'model': this.model.toJSON()
        }));
        $('#' + this.focusedElementId).focus();
    },
    update: function(data) { 
          
        //console.log('shipping_method:render');    
        
        //console.log(data.shipping_method);
        if (data.shipping_method) {
            this.model.set('shipping_method', data.shipping_method);
        }
        if (typeof(data.show_shipping_method) !== 'undefined') {
            this.model.set('show_shipping_method', data.show_shipping_method);
        }
        if (data.shipping_methods) {
            this.model.set('shipping_methods', data.shipping_methods);
        }
        if (data.shipping_error) {
            this.model.set('shipping_error', data.shipping_error);
        }
        if (data.account && data.account !== this.model.get('account')) {
            this.changeAccount(data.account);
        }
        if (data.shipping_method_error) {
            this.model.set('error', data.shipping_method_error);
        }
    },
});
qc.PaymentMethod = qc.Model.extend({
    defaults: '',
    initialize: function() {
        this.set('config', config.account[this.get('account')].payment_method);
    },
    changeAccount: function(account) {
        this.set('account', account);
        this.set('config', config.account[this.get('account')].payment_method);
    },
    update: function(json) {
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/payment_method/update'+lang, json, function(data) {
            that.updateForm(data);
        }, 'json');
    },
});
qc.PaymentMethodView = qc.View.extend({
    initialize: function(e) {
        this.template = e.template;
        qc.event.bind("update", this.update, this);
        this.model.on("change", this.render, this);
        this.render();
    },
    events: {
        'change input[type=radio]': 'updatePaymentMethod',
        'change select': 'updatePaymentMethod',
        'change input#payment_address_customer_group_id_1': 'console.log(\'ok\');',
        'change input#payment_address_customer_group_id_4': 'console.log(\'ok\');',
    },
    template: '',
    updatePaymentMethod: function(e) {
        this.model.update($('#payment_method_form').serializeArray());
        if (this.model.get('config.input_style') == 'radio') {
            $('.payment-method-terms').hide();
            $('.payment-method-terms.' + e.currentTarget.value).show();
        }
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'update', 'payment_method.' + e.currentTarget.value);
        }
        preloaderStart();
    },
    update: function(data) {
        if (data.payment_method) {
            this.model.set('payment_method', data.payment_method);
        }
        if (data.payment_methods) {
            this.model.set('payment_methods', data.payment_methods);
        }
        if (data.payment_error) {
            this.model.set('payment_error', data.payment_error);
        }
        if (data.account && data.account !== this.model.get('account')) {
            this.changeAccount(data.account);
        }
    },
    render: function() {
        this.focusedElementId = $(':focus').attr('id');
        //console.log('payment_method:render');
        $(this.el).html(this.template({
            'model': this.model.toJSON()
        }));
        $('img').on('error',function() {
            $(this).hide();
        });
        /*$('img').error(function() {
            $(this).hide();
        });*/
        $('#' + this.focusedElementId).focus();
    },
});
qc.Cart = qc.Model.extend({
    defaults: '',
    initialize: function() {
        this.set('config', config.account[this.get('account')].cart);
    },
    changeAccount: function(account) {
        this.set('account', account);
        this.set('config', config.account[this.get('account')].cart);
    },
    updateCart: function() {
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/cart/update'+lang, '', function(data) {
            that.updateForm(data);
        }, 'json');
    },
    updateQuantity: function(name, value) {
        this.set(name, value);
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/cart/update'+lang, this.toJSON(), function(data) {
            that.updateForm(data);
        }, 'json');
    },
    updateVoucher: function(voucher) {
        this.set('voucher', voucher);
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/cart/updateVoucher'+lang, this.toJSON(), function(data) {
            that.updateForm(data);
        }, 'json');
    },
    updateCoupon: function(coupon) {
        this.set('coupon', coupon);
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/cart/updateCoupon'+lang, this.toJSON(), function(data) {
            that.updateForm(data);
        }, 'json');
    },
    updateReward: function(reward) {
        this.set('reward', reward);
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/cart/updateReward'+lang, this.toJSON(), function(data) {
            that.updateForm(data);
        }, 'json');
    },
});
qc.CartView = qc.View.extend({
    initialize: function(e) {
        this.template = e.template;
        qc.event.bind("update", this.update, this);
        this.model.on("change", this.render, this);
        this.render();
    },
    events: {
        'click button.increase': 'increaseQuantity',
        'click button.decrease': 'decreaseQuantity',
        'click button.delete': 'deleteQuantity',
        'change input.qc-product-qantity': 'updateQuantity',
        'change input#voucher': 'updateVoucher',
        'change input#coupon': 'updateCoupon',
        'change input#reward': 'updateReward',
    },
    template: '',
    decreaseQuantity: function(e) {
        var quantity = $(e.currentTarget).parents('.qc-quantity').find('input.qc-product-qantity');
        this.model.updateQuantity(quantity.attr('name'), parseInt(quantity.val()) - 1);
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'click', 'cart.quantity.decrease');
        }
        preloaderStart();
    },
    increaseQuantity: function(e) {
        var quantity = $(e.currentTarget).parents('.qc-quantity').find('input.qc-product-qantity');
        this.model.updateQuantity(quantity.attr('name'), parseInt(quantity.val()) + 1);
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'click', 'cart.quantity.increase');
        }
        preloaderStart();
    },
    deleteQuantity: function(e) {
        var quantity = $(e.currentTarget).parents('.qc-quantity').find('input.qc-product-qantity');
        this.model.updateQuantity(quantity.attr('name'), 0);
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'click', 'cart.quantity.delete');
        }
        preloaderStart();
    },
    updateQuantity: function(e) {
        var quantity = $(e.currentTarget);
        this.model.updateQuantity(quantity.attr('name'), parseInt(quantity.val()));
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'update', 'cart.quantity');
        }
        preloaderStart();
    },
    updateHeaderCart: function(total) {
        setTimeout(function() {
            $('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + total + '</span>');
        }, 100);
        $('#cart > ul').load('index.php?route=common/cart/info'+lang+' ul li');
    },
    updateVoucher: function(e) {
        this.model.updateVoucher($(e.currentTarget).val());
        this.model.set('errors', []);
        this.model.set('successes', []);
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'update', 'cart.voucher');
        }
        preloaderStart();
    },
    updateCoupon: function(e) {
        this.model.updateCoupon($(e.currentTarget).val());
        this.model.set('errors', []);
        this.model.set('successes', []);
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'update', 'cart.coupon');
        }
        preloaderStart();
    },
    updateReward: function(e) {
        this.model.updateReward($(e.currentTarget).val());
        this.model.set('errors', []);
        this.model.set('successes', []);
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'update', 'cart.reward');
        }
        preloaderStart();
    },
    update: function(data) {
        if (data.cart) {
            this.model.set('cart', data.cart);
        }
        if (data.products) {
            this.model.set('products', data.products);
        }
        if (data.vouchers) {
            this.model.set('vouchers', data.vouchers);
        }
        if (data.totals) {
            this.model.set('totals', data.totals);
            this.updateHeaderCart(data.total);
        }
        if (data.cart_errors) {
            this.model.set('errors', data.cart_errors);
        }
        if (typeof(data.cart_error) !== 'undefined') {
            this.model.set('error', data.cart_error);
        }
        if (data.cart_successes) {
            this.model.set('successes', data.cart_successes);
        }
        if (typeof(data.show_price) !== 'undefined') {
            this.model.set('show_price', data.show_price);
        }
        if (data.account && data.account !== this.model.get('account')) {
            this.changeAccount(data.account);
        }
        if (data.cart_weight) {
            this.model.set('cart_weight', data.cart_weight);
        }
    },
    render: function() {
        this.focusedElementId = $(':focus').attr('id');
        //console.log('cart:render');
        $(this.el).html(this.template({
            'model': this.model.toJSON()
        }));
        $('.qc-product-qantity').each(function() {
            $(this).mask($(this).attr('data-mask'), {
                placeholder: ""
            });
        });
        $('#' + this.focusedElementId).focus();
    },
});
qc.Payment = qc.Model.extend({
    defaults: '',
    initialize: function() {
        this.set('config', config.account[this.get('account')].payment);
    },
    changeAccount: function(account) {
        this.set('account', account);
        this.set('config', config.account[this.get('account')].payment);
    },
});
qc.PaymentView = qc.View.extend({
    initialize: function(e) {
        this.template = e.template;
        qc.event.bind("update", this.update, this);
        qc.event.bind("paymentConfirm", this.paymentConfirm, this);
        this.model.on("change", this.render, this);
        this.render();
    },
    template: '',
    paymentConfirm: function() {
        $('#payment_view .alert').remove();
        if (Number(this.model.get('payment_popup'))) {
            $('#payment_modal').modal('show');
        } else {
            var href = $(this.model.get('trigger'), this.$el).attr('href');
            if (href != '' && href != undefined) {
                document.location.href = href;
            } else {
                $(this.model.get('trigger'), this.$el).click();
            }
        }
    },
    update: function(data) {
        if (data.payment && data.payment_popup_title) {
            this.model.set({
                'payment': data.payment,
                'payment_popup_title': data.payment_popup_title
            });
        } else if (data.payment && typeof(data.payment_popup_title) == 'undefined') {
            this.model.set('payment', data.payment);
        } else if (typeof(data.payment) == 'undefined' && data.payment_popup_title) {
            this.model.set(data.payment_popup_title);
        }
        if (typeof(data.payment_popup) !== 'undefined') {
            this.model.set('payment_popup', data.payment_popup);
        }
        if (data.account && data.account !== this.model.get('account')) {
            this.changeAccount(data.account);
        }
    },
    render: function() {
        this.focusedElementId = $(':focus').attr('id');
        //console.log('payment:render');
        $(this.el).html(this.template({
            'model': this.model.toJSON()
        }));
        $('#' + this.focusedElementId).focus();
    },
});
qc.Confirm = qc.Model.extend({
    defaults: {
        'confirm': '',
        'config': '',
        'account': ''
    },
    initialize: function() {
        this.set('config', config.account[this.get('account')].confirm);
    },
    changeAccount: function(account) {
        this.set('account', account);
        this.set('config', config.account[this.get('account')].confirm);
    },
    updateField: function(name, value) {
        //console.log('updateField');
        this.set(name, value);
        var json = this.toJSON();
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/confirm/updateField'+lang, {
            'confirm': json.confirm
        }, function(data) {
            that.updateForm(data);
        }, 'json');
    },
    update: function() {
        //console.log('update');
        var that = this;
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/confirm/update'+lang, {}, function(data) {
            that.updateForm(data);
            qc.event.trigger('paymentConfirm');
            that.recreateOrder();
        }, 'json');
    },
    recreateOrder: function() {
        //console.log('recreateOrder');
        var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
        $.post('index.php?route=d_quickcheckout/confirm/recreateOrder'+lang, '', function(data) {}, 'json');
    }
});
qc.ConfirmView = qc.View.extend({
    initialize: function(e) {
        this.template = e.template;
        qc.event.bind("update", this.update, this);
        qc.event.bind("changeAccount", this.changeAccount, this);
        this.render();
    },
    events: {
        'click button#qc_confirm_order': 'confirm',
    },
    template: '',
    confirm: function() {
        
        preloaderStart();
        var valid = true;
        if ($(".has-error").length) {
            valid = false;
            preloaderStop();
            $('html,body').animate({
                scrollTop: $(".has-error").offset().top - 60
            }, 'slow');
        }
        $("#d_quickcheckout form").each(function() {
            if (!$(this).valid()) {
                valid = false;
                preloaderStop();
                $('html,body').animate({
                    scrollTop: 100
                }, 'slow');
            }
        });
        //console.log('confirm',valid);
        //console.log('confirm',this);
        
        // ???? ???????????? ????????????, ???????????????????? ?? ???????????? ???????????????? ???????????????????????????????? ??????????
        var ukrpost_address=$('#ukrpost_address').val();
        var free_address=$('#free_address').val();
        var flat_address=$('#flat_address').val();
        // var np_city=$('#flat_address').val();
        // var flat_address=$('#flat_address').val();
        // var flat_address=$('#flat_address').val();
        
        /*console.log(flat_address);
        console.log(ukrpost_address);
        console.log(free_address);*/

        if (ukrpost_address || flat_address || free_address) {
            // ???????????????????? ?? ???????????? ???????????????? ???????????????????????????????? ?????????? - ???? ?????? ?????????? ???? ????????!
            // 
            var userdata={
                'ukrpost_address': ukrpost_address,
                'flat_address': flat_address,
                'free_address': free_address
            };        
            console.log('confirm - ?????????????????',userdata);

            var lang='';
            language = jQuery('html').attr('lang');
            if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}

            /*$.post('index.php?route=d_quickcheckout/shipping_method/prepareuser'+lang, userdata, function(data) {
            }, 'json');*/

            $.ajax({
                url: "index.php?route=d_quickcheckout/shipping_method/prepareuser"+lang,
                async: false,
                method: 'POST',
                dataType: "json",
                data: userdata,
                success: function(data) {
                
                }
            });

            // **************************************************************************
            // return;
        }
        
        if (this.model.get('account') == 'register') {
            email = $("#d_quickcheckout #payment_address_form #payment_address_email")
            emailVal = email.val();
            var that = this;
            var lang='';
        language = jQuery('html').attr('lang');
        if(language=='uk' || language=='uk-UA'){lang='&lang=ua';}
            $.ajax({
                url: "index.php?route=d_quickcheckout/field/validate_email"+lang,
                async: false,
                method: 'GET',
                dataType: "json",
                data: 'email=' + emailVal,
                success: function(data) {
                    if (data != true) {
                        valid = false
                        preloaderStop();
                        $('html,body').animate({
                            scrollTop: $(".has-error").offset().top - 60
                        }, 'slow');
                    }
                    if (valid) {
                        that.model.update();
                    }
                }
            });
        } else {
            if (valid) {
                this.model.update();
            }
        }
        if (parseInt(config.general.analytics_event)) {
            ga('send', 'event', config.name, 'click', 'confirm.confirm');
        }
    },
    changeAccount: function(account) {
        if (this.model.get('account') !== account) {
            this.model.changeAccount(account);
            this.render();
        }
    },
    update: function(data) {
        //console.log('updt');
        if (data.confirm) {
            this.model.set('confirm', data.confirm);
        }
        if (typeof(data.show_confirm) !== 'undefined') {
            this.model.set('show_confirm', data.show_confirm);
            this.render();
        }
        if (typeof(data.payment_popup) !== 'undefined') {
            this.model.set('payment_popup', data.payment_popup);
            this.render();
        }
        if (data.account && data.account !== this.model.get('account')) {
            this.changeAccount(data.account);
        }
    },
    render: function() {
        this.focusedElementId = $(':focus').attr('id');
        //console.log('confirm:render');
        $(this.el).html(this.template({
            'model': this.model.toJSON()
        }));
        this.fields = new qc.FieldView({
            el: $("#confirm_form"),
            model: this.model,
            template: _.template($("#field_template").html())
        });
        this.fields.render();
        $('#' + this.focusedElementId).focus();
        simple_tooltip("#confirm_no_call_input span","tooltip");
        
    },
});