<?php

/**
 * Cuts last five symbols
 * @param date_str {String}
 */
function cut_year_dmy($date_str) {
	$new_format = substr($date_str, 0, -5);
	return $new_format;
}

