<?php
class Pagination {
	public $total = 0;
	public $page = 1;
	public $limit = 20;
	public $num_links = 9;
	public $url = '';
// 	public $text_first = '|&lt;';
// 	public $text_last = '&gt;|';
// 	public $text_next = '&gt;';
// 	public $text_prev = '&lt;';
  	public $text_first = '{first}';
	public $text_last = '{last}';
	public $text_next = '{next}';
	public $text_prev = '{prev}';

	public function render() {
		$total = $this->total;

		if ($this->page < 1) {
			$page = 1;
		} else {
			$page = $this->page;
		}

		if (!(int)$this->limit) {
			$limit = 10;
		} else {
			$limit = $this->limit;
		}

		$num_links = $this->num_links;
		$num_pages = ceil($total / $limit);

		$this->url = str_replace('%7Bpage%7D', '{page}', $this->url);

		// добавляем стили
		$output = '<style>';
		$output .= file_get_contents(DIR_APPLICATION.'view/js/pagination.css');
		$output .= '</style>';
		$output .= '<ul class="pagination">';

		if ($page > 1) {
			$tmp_url = str_replace('&amp;', '&', $this->url);
			if($this->text_first){
				$output .= '<li><a href="' . str_replace('&', '&amp;', rtrim( str_replace('page={page}', '', $tmp_url), '?&')) . '">' . $this->text_first . '</a></li>';
			}
			if ($page == 2){
				$output .= '<li class="prev"><a href="' . str_replace('&', '&amp;', rtrim( str_replace('page={page}', '', $tmp_url), '?&')) . '">' . $this->text_prev . '</a></li>';
			}else{
				$output .= '<li class="prev"><a href="' . str_replace('{page}', $page - 1, $this->url) . '">' . $this->text_prev . '</a></li>';
			}
		}

		if ($num_pages > 1) {
			if ($num_pages <= $num_links) {
				$start = 1;
				$end = $num_pages;
			} else {
				$start = $page - floor($num_links / 2);
				$end = $page + floor($num_links / 2);

				if ($start < 1) {
					$end += abs($start) + 1;
					$start = 1;
				}

				if ($end > $num_pages) {
					$start -= ($end - $num_pages);
					$end = $num_pages;
				}
			}

			for ($i = $start; $i <= $end; $i++) {
				if ($page == $i) {
					$output .= '<li class="active"><span>' . $i . '</span></li>';
				} else {
					if ($i == 1){
						$output .= '<li><a href="' . str_replace('&', '&amp;', rtrim( str_replace('page={page}', '', $tmp_url), '?&')) . '">' . $i . '</a></li>';
					}else{
						$output .= '<li><a href="' . str_replace('{page}', $i, $this->url) . '">' . $i . '</a></li>';
					}
				}
			}
		}

		if ($page < $num_pages) {
			$output .= '<li class="next"><a href="' . str_replace('{page}', $page + 1, $this->url) . '">' . $this->text_next . '</a></li>';
			if($this->text_last){
				$output .= '<li><a href="' . str_replace('{page}', $num_pages, $this->url) . '">' . $this->text_last . '</a></li>';
			}
		}

		$output .= '</ul>';

		if ($num_pages > 1) {
			return $output;
		} else {
			return '';
		}
	}
}