document.addEventListener('DOMContentLoaded', () => {
	let isLoading = false;
	let queryData = { cid: -999, start: -999, count: 48 };
	let total = -999;
	$.ajax({
		url: Joe.BASE_API,
		type: 'POST',
		dataType: 'json',
		data: { routeType: 'wallpaper_type' },
		success(res) {
			if (res.code !== 1) return $('.joe_wallpaper__type-list').html('<li class="error">壁纸抓取失败！请联系作者！</li>');
			if (!res.data.length) return $('.joe_wallpaper__type-list').html(`<li class="error">暂无数据！</li>`);
			let htmlStr = '';
			res.data.forEach(_ => (htmlStr += `<li class="item animated swing" data-cid="${_.id}">${_.name}</li>`));
			$('.joe_wallpaper__type-list').html(htmlStr);
			$('.joe_wallpaper__type-list .item').first().click();
		}
	});
	$('.joe_wallpaper__type-list').on('click', '.item', function () {
		const cid = $(this).attr('data-cid');
		if (isLoading) return;
		$(this).addClass('active').siblings().removeClass('active');
		queryData.cid = cid;
		queryData.start = 0;
		renderDom();
	});
	function renderDom() {
		window.scrollTo({ top: 0, behavior: 'smooth' });
		$('.joe_wallpaper__list').html('');
		isLoading = true;
		$.ajax({
			url: Joe.BASE_API,
			type: 'POST',
			dataType: 'json',
			data: {
				routeType: 'wallpaper_list',
				cid: queryData.cid,
				start: queryData.start,
				count: queryData.count
			},
			success(res) {
				if (res.code !== 1) return (isLoading = false);
				isLoading = false;
				let htmlStr = '';
				res.data.forEach(_ => {
					htmlStr += `
						<a class="item animated bounceIn" data-fancybox="gallery" href="${_.url}">
							<img width="100%" height="100%" class="lazyload" src="${Joe.LAZY_LOAD}" data-src="${_.img_1024_768 || _.url}" alt="壁纸">
						</a>`;
				});
				$('.joe_wallpaper__list').html(htmlStr);
				total = res.total;
				initPagination();
			}
		});
	}
	function initPagination() {
		let htmlStr = '';
		if (queryData.start / queryData.count !== 0) {
			htmlStr += `
				<li class="joe_wallpaper__pagination-item" data-start="0">首页</li>
				<li class="joe_wallpaper__pagination-item hide-sm" data-start="${queryData.start - queryData.count}">
					<i class="fa fa-angle-left em12"></i><span class="ml6">上一页</span>
				</li>
				<li class="joe_wallpaper__pagination-item" data-start="${queryData.start - queryData.count}">${Math.ceil(queryData.start / queryData.count)}</li>
			`;
		}
		htmlStr += `<li class="joe_wallpaper__pagination-item active">${Math.ceil(queryData.start / queryData.count) + 1}</li>`;
		if (queryData.start != total - queryData.count) {
			htmlStr += `
				<li class="joe_wallpaper__pagination-item" data-start="${queryData.start + queryData.count}">${Math.ceil(queryData.start / queryData.count) + 2}</li>
				<li class="joe_wallpaper__pagination-item hide-sm" data-start="${queryData.start + queryData.count}">
					<span class="mr6">下一页</span><i class="fa fa-angle-right em12"></i>
				</li>
			`;
		}
		if (queryData.start < total - queryData.count) htmlStr += `<li class="joe_wallpaper__pagination-item" data-start="${total - queryData.count}">末页</li>`;
		$('.joe_wallpaper__pagination').html(htmlStr);
	}
	$('.joe_wallpaper__pagination').on('click', '.joe_wallpaper__pagination-item', function () {
		const start = $(this).attr('data-start');
		if (!start || isLoading) return;
		queryData.start = Number(start);
		renderDom();
	});
});