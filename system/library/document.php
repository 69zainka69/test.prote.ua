<?php
class Document {
	private $title;
	private $description;
	private $keywords;
	private $links = array();
	private $styles = array();
	private $scripts = array();
	private $og_image;
	private $og_title;
	private $og_description;

	public function setTitle($title) {
		$this->title = $title;
	}

	public function getTitle() {
		return $this->title;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setKeywords($keywords) {
		$this->keywords = $keywords;
	}

	public function getKeywords() {
		return $this->keywords;
	}

	public function addLink($href, $rel) {
		$this->links[$href] = array(
			'href' => $href,
			'rel'  => $rel
		);
	}

	public function getLinks() {
		return $this->links;
	}

	public function addStyle($href, $rel = 'stylesheet', $media = 'screen') {
		$this->styles[$href] = array(
			'href'  => $href,
			'rel'   => $rel,
			'media' => $media
		);
	}

	public function getStyles() {
		return $this->styles;
	}

	public function addScript($href, $postion = 'header', $async = '') {
		$this->scripts[$postion][$href] = [ $href , $async ];
	}

	public function getScripts($postion = 'header') {
		if (isset($this->scripts[$postion])) {
			return $this->scripts[$postion];
		} else {
			return array();
		}
	}

	public function setOgImage($image) {
		$this->og_image = $image;
	}
	public function getOgImage() {
		return $this->og_image;
	}

	public function setOgTitle($title) {
		$this->og_title = $title;
	}
	public function getOgTitle() {
		return $this->og_title;
	}

	public function setOgDescription($description) {
		$this->og_description = $description;
	}
	public function getOgDescription() {
		return $this->og_description;
	}
}
