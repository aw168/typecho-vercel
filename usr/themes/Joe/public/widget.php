<?php

if (!defined('__TYPECHO_ROOT_DIR__')) {
	http_response_code(404);
	exit;
}

class Widget_Contents_Hot extends Widget_Abstract_Contents
{
	public function execute()
	{
		$recommend_text = Joe\isMobile() ? Helper::options()->JIndex_Mobile_Recommend : Helper::options()->JIndex_Recommend;
		$recommend = joe\optionMulti($recommend_text, '||', false);
		if (empty($recommend)) $recommend = ['empty'];
		$this->parameter->setDefault(array('pageSize' => 10));
		$select = $this->select();
		$select->cleanAttribute('fields');
		$this->db->fetchAll(
			$select->from('table.contents')
				->where('table.contents.cid NOT' . "\r\n" . 'IN?', $recommend)
				->where("table.contents.password IS NULL OR table.contents.password = ''")
				->where('table.contents.status = ?', 'publish')
				->where('table.contents.created <= ?', time())
				->where('table.contents.type = ?', 'post')
				->limit($this->parameter->pageSize)
				->order('table.contents.views', Typecho_Db::SORT_DESC),
			array($this, 'push')
		);
	}
}

class Widget_Contents_Sort extends Widget_Abstract_Contents
{
	public function execute()
	{
		$this->parameter->setDefault(array('page' => 1, 'pageSize' => 10, 'type' => 'created'));
		$offset = $this->parameter->pageSize * ($this->parameter->page - 1);
		$select = $this->select();
		$select->cleanAttribute('fields');
		$this->db->fetchAll(
			$select
				->from('table.contents')
				->where('table.contents.type = ?', 'post')
				->where('table.contents.status = ?', 'publish')
				->where('table.contents.created < ?', time())
				->limit($this->parameter->pageSize)
				->offset($offset)
				->order($this->parameter->type, Typecho_Db::SORT_DESC),
			array($this, 'push')
		);
	}
}

class Widget_Contents_Post extends Widget_Abstract_Contents
{
	public function execute()
	{
		$select = $this->select();
		$select->cleanAttribute('fields');
		$this->db->fetchAll(
			$select
				->from('table.contents')
				->where('table.contents.type = ?', 'post')
				->where('table.contents.cid = ?', $this->parameter->cid)
				->limit(1),
			array($this, 'push')
		);
	}
}
