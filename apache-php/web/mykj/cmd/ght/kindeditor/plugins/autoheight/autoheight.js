/*******************************************************************************
* KindEditor - WYSIWYG HTML Editor for Internet
* Copyright (C) 2006-2011 kindsoft.net
*
* @author Roddy <luolonghao@gmail.com>
* @site http://www.kindsoft.net/
* @licence http://www.kindsoft.net/license.php
*******************************************************************************/

KindEditor.plugin('autoheight', function(K) {
	var self = this;

	if (!self.autoHeightMode) {
		return;
	}

	var minHeight;

	function hideScroll() {
		var edit = self.edit;
		var body = edit.doc.body;
		edit.iframe[0].scroll = 'no';
		body.style.overflowY = 'hidden';
	}

	function resetHeight() {
		var edit = self.edit;
		var body = edit.doc.body;
		edit.iframe.height(minHeight);
		self.resize(null, Math.max((K.IE ? body.scrollHeight : body.offsetHeight) + 76, minHeight));
	}

	function init() {
		minHeight = K.removeUnit(self.height);

		self.edit.afterChange(resetHeight);
		hideScroll();
		resetHeight();
	}

	if (self.isCreated) {
		init();
	} else {
		self.afterCreate(init);
	}
});

/*
* ���ʵ���������Զ��߶ȣ�
* �޸ı༭���߶�֮���ٴλ�ȡbody���ݸ߶�ʱ����Сֵֻ���ǵ�ǰiframe�����ø߶ȣ������͵��¸߶�ֻ��������
* ����ÿ�λ�ȡbody���ݸ߶�֮ǰ���Ƚ�iframe�ĸ߶�����Ϊ��С�߶ȣ��������ܻ�ȡbody��ʵ�ʸ߶ȡ�
* �ɴ˾�ʵ�����������Զ��߶�
* ���ԣ�chrome��firefox��IE9��IE8
* */
