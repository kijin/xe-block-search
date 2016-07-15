<?php

if (!defined('__XE__'))
{
	exit;
}

if (Context::get('logged_info'))
{
	return;
}

if ($called_position === 'before_module_proc')
{
	if ($addon_info->block_board_search === 'Y' && ($search_target = Context::get('search_target')) && Context::get('search_keyword'))
	{
		if ($addon_info->block_member_document_search !== 'N' || $search_target !== 'nick_name')
		{
			Context::loadLang(dirname(__FILE__) . '/lang');
			$this->stop('msg_guest_search_blocked_board');
			$this->act = ':blocked:';
		}
	}
	
	if ($addon_info->block_total_search === 'Y' && $this->act === 'IS' && Context::get('is_keyword'))
	{
		Context::loadLang(dirname(__FILE__) . '/lang');
		$this->stop('msg_guest_search_blocked_is');
		$this->act = ':blocked:';
	}
}

if ($called_position === 'after_module_proc' && $this->module === 'member' && $this->act === 'getMemberMenu')
{
	if ($addon_info->block_member_document_search !== 'N')
	{
		foreach ($this->variables['menus'] as $menu_key => $menu_value)
		{
			if (strpos($menu_value->url, 'search_target=nick_name') !== false)
			{
				unset($this->variables['menus'][$menu_key]);
			}
		}
	}
}
