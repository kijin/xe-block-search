<?php

if (!defined('__XE__'))
{
	exit;
}

if ($called_position !== 'before_module_proc')
{
	return;
}

if (Context::get('logged_info'))
{
	return;
}

if ($addon_info->block_board_search === 'Y' && Context::get('search_target') && Context::get('search_keyword'))
{
	Context::loadLang(dirname(__FILE__) . '/lang');
	$this->stop('msg_guest_search_blocked_board');
	$this->act = ':blocked:';
}

if ($addon_info->block_total_search === 'Y' && $this->act === 'IS' && Context::get('is_keyword'))
{
	Context::loadLang(dirname(__FILE__) . '/lang');
	$this->stop('msg_guest_search_blocked_is');
	$this->act = ':blocked:';
}
