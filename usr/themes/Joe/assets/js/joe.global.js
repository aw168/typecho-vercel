document.addEventListener("DOMContentLoaded", () => {

	/* 检测IE */
	{
		function detectIE() {
			var n = window.navigator.userAgent,
				e = n.indexOf("MSIE ");
			if (e > 0) {
				return parseInt(n.substring(e + 5, n.indexOf(".", e)), 10)
			}
			if (n.indexOf("Trident/") > 0) {
				var r = n.indexOf("rv:");
				return parseInt(n.substring(r + 3, n.indexOf(".", r)), 10)
			}
			var i = n.indexOf("Edge/");
			return i > 0 && parseInt(n.substring(i + 5, n.indexOf(".", i)), 10)
		};
		detectIE() && (alert('当前站点不支持IE浏览器或您开启了兼容模式，请使用其他浏览器访问或关闭兼容模式。'), (location.href = 'https://www.baidu.com'))
	}

	/* 设置$.getScript()方法缓存 */
	{
		jQuery.ajaxSetup({
			cache: true
		});
	}

	/* 展示百度统计信息 */
	{
		if ($('#statistics').is(':visible')) {
			$.ajax({
				url: Joe.BASE_API,
				type: 'POST',
				dataType: 'json',
				data: {
					routeType: 'statistics'
				},
				success(data) {
					if (data.access_token == 'off') {
						$("#statistics").remove();
						return;
					}
					if (data.msg) {
						$("#statistics").remove();
						data.code == 200 ? Qmsg.info('百度统计：' + data.msg) : Qmsg.error('百度统计：' + data.msg);
						return;
					}
					let statistics = $('#statistics span strong');
					$(statistics[0]).text(data['today'][0]);
					$(statistics[1]).text(data['yesterday'][1]);
					$(statistics[2]).text(data['month'][0]);
				},
				error() {
					$("#statistics").remove();
				}
			});
		}
	}

	/* 初始化昼夜模式 */
	{
		if (localStorage.getItem("data-night") || $("html").attr("data-night") == 'night') {
		} else {
			$("html").removeAttr("data-night");
		}
		if (document.querySelector('.toggle-theme')) {
			$(".toggle-theme").on("click", () => {
				$(".joe_action_item.mode").click();
			});
		}
		if (document.querySelector('.joe_action_item.mode')) {
			if (localStorage.getItem("data-night") || $("html").attr("data-night") == 'night') {
				$(".joe_action_item.mode .icon-1").addClass("active");
				$(".joe_action_item.mode .icon-2").removeClass("active");
				$('body').addClass('dark-theme');
				let switchSrc = $('.navbar-logo>img').attr('switch-src');
				let src = $('.navbar-logo>img').attr('src');
				$('.navbar-logo>img').attr('src', switchSrc);
				$('.navbar-logo>img').attr('switch-src', src);
				if (!Joe.IS_MOBILE) {
					$(".joe_action_item.mode").attr('data-original-title', '日间模式');
					$(".joe_action_item.mode").tooltip({
						container: "body"
					});
				}
			} else {
				$(".joe_action_item.mode .icon-1").removeClass("active");
				$(".joe_action_item.mode .icon-2").addClass("active");
				$('body').removeClass('dark-theme');
				if (!Joe.IS_MOBILE) {
					$(".joe_action_item.mode").attr('data-original-title', '夜间模式');
					$(".joe_action_item.mode").tooltip({
						container: "body"
					});
				}
			}
			$(".joe_action_item.mode").on("click", () => {
				let switchSrc = $('.navbar-logo>img').attr('switch-src');
				let src = $('.navbar-logo>img').attr('src');
				$('.navbar-logo>img').attr('src', switchSrc);
				$('.navbar-logo>img').attr('switch-src', src);
				if (localStorage.getItem("data-night") || $("html").attr("data-night") == 'night') {
					$(".joe_action_item.mode .icon-1").removeClass("active");
					$(".joe_action_item.mode .icon-2").addClass("active");
					$('body').removeClass('dark-theme');
					$("html").removeAttr("data-night");
					localStorage.removeItem("data-night");
					if (!Joe.IS_MOBILE) {
						$(".joe_action_item.mode").attr('data-original-title', '夜间模式');
						$(".joe_action_item.mode").tooltip({
							container: "body"
						});
					}
				} else {
					$(".joe_action_item.mode .icon-1").addClass("active");
					$(".joe_action_item.mode .icon-2").removeClass("active");
					$('body').addClass('dark-theme');
					$("html").attr("data-night", "night");
					localStorage.setItem("data-night", "night");
					if (!Joe.IS_MOBILE) {
						$(".joe_action_item.mode").attr('data-original-title', '日间模式');
						$(".joe_action_item.mode").tooltip({
							container: "body"
						});
					}
				}
			});
		}
	}

	/* 动态背景 */
	{
		if (!Joe.IS_MOBILE && Joe.DYNAMIC_BACKGROUND !== "off" && Joe.DYNAMIC_BACKGROUND && !Joe.WALLPAPER_BACKGROUND_PC) {
			$.getScript(`${Joe.THEME_URL}assets/plugin/backdrop/${Joe.DYNAMIC_BACKGROUND}`);
		}
	}

	/* 搜索框弹窗 */
	{
		$(".joe_header__above-search .input").on("click", (e) => {
			e.stopPropagation();
			$(".joe_header__above-search .result").addClass("active");
		});
		$(document).on("click", function () {
			$(".joe_header__above-search .result").removeClass("active");
		});
	}

	/* 激活全局下拉框功能 */
	{
		$(".joe_dropdown").each(function (index, item) {
			const menu = $(this).find(".joe_dropdown__menu");
			const trigger = $(item).attr("trigger") || "click";
			const placement = $(item).attr("placement") || $(this).height() || 0;
			menu.css("top", placement);
			if (trigger === "hover") {
				$(this).hover(
					() => $(this).addClass("active"),
					() => $(this).removeClass("active")
				);
			} else {
				$(this).on("click", function (e) {
					$(this).toggleClass("active");
					$(document).one("click", () => $(this).removeClass("active"));
					e.stopPropagation();
				});
				menu.on("click", (e) => e.stopPropagation());
			}
		});
	}

	/* 激活全局返回顶部功能 */
	{
		$(".joe_action_item.scroll").on("click", () => window.scrollTo({
			top: 0,
			behavior: "smooth"
		}));
	}

	/* 激活侧边栏人生倒计时功能 */
	{
		if ($(".joe_aside__item.timelife").length) {
			let timelife = [{
				title: "今日已经过去",
				endTitle: "小时",
				num: 0,
				percent: "0%"
			},
			{
				title: "这周已经过去",
				endTitle: "天",
				num: 0,
				percent: "0%"
			},
			{
				title: "本月已经过去",
				endTitle: "天",
				num: 0,
				percent: "0%"
			},
			{
				title: "今年已经过去",
				endTitle: "个月",
				num: 0,
				percent: "0%"
			},
			]; {
				let nowDate = +new Date();
				let todayStartDate = new Date(new Date().toLocaleDateString()).getTime();
				let todayPassHours = (nowDate - todayStartDate) / 1000 / 60 / 60;
				let todayPassHoursPercent = (todayPassHours / 24) * 100;
				timelife[0].num = parseInt(todayPassHours);
				timelife[0].percent = parseInt(todayPassHoursPercent) + "%";
			} {
				let weeks = {
					0: 7,
					1: 1,
					2: 2,
					3: 3,
					4: 4,
					5: 5,
					6: 6
				};
				let weekDay = weeks[new Date().getDay()];
				let weekDayPassPercent = (weekDay / 7) * 100;
				timelife[1].num = parseInt(weekDay);
				timelife[1].percent = parseInt(weekDayPassPercent) + "%";
			} {
				let year = new Date().getFullYear();
				let date = new Date().getDate();
				let month = new Date().getMonth() + 1;
				let monthAll = new Date(year, month, 0).getDate();
				let monthPassPercent = (date / monthAll) * 100;
				timelife[2].num = date;
				timelife[2].percent = parseInt(monthPassPercent) + "%";
			} {
				let month = new Date().getMonth() + 1;
				let yearPass = (month / 12) * 100;
				timelife[3].num = month;
				timelife[3].percent = parseInt(yearPass) + "%";
			}
			let htmlStr = "";
			timelife.forEach((item, index) => {
				htmlStr += `
						<div class="item">
							<div class="title">
								${item.title}
								<span class="text">${item.num}</span>
								${item.endTitle}
							</div>
							<div class="progress">
								<div class="progress-bar">
									<div class="progress-bar-inner progress-bar-inner-${index}" style="width: ${item.percent}"></div>
								</div>
								<div class="progress-percentage">${item.percent}</div>
							</div>
						</div>`;
			});
			$(".joe_aside__item.timelife .joe_aside__item-contain").html(htmlStr);
		}
	}

	/* 激活侧边栏天气功能 */
	{
		if ($(".joe_aside__item.weather").length) {
			const key = $(".joe_aside__item.weather").attr("data-key");
			const style = $(".joe_aside__item.weather").attr("data-style");
			const aqiColor = {
				1: "FFFFFF",
				2: "4A4A4A",
				3: "FFFFFF"
			};
			window.WIDGET = {
				CONFIG: {
					layout: 2,
					width: "220",
					height: "270",
					background: style,
					dataColor: aqiColor[style],
					language: "zh",
					key
				}
			};
			$.getScript("https://widget.qweather.net/standard/static/js/he-standard-common.js?v=2.0");
		}
	}

	/* 3d云标签 */
	{
		if ($(".joe_aside__item.tags").length && $(".joe_aside__item.tags").svg3DTagCloud) {
			const entries = [];
			const colors = [
				"#F8D800",
				"#0396FF",
				"#EA5455",
				"#7367F0",
				"#32CCBC",
				"#F6416C",
				"#28C76F",
				"#9F44D3",
				"#F55555",
				"#736EFE",
				"#E96D71",
				"#DE4313",
				"#D939CD",
				"#4C83FF",
				"#F072B6",
				"#C346C2",
				"#5961F9",
				"#FD6585",
				"#465EFB",
				"#FFC600",
				"#FA742B",
				"#5151E5",
				"#BB4E75",
				"#FF52E5",
				"#49C628",
				"#00EAFF",
				"#F067B4",
				"#F067B4",
				"#ff9a9e",
				"#00f2fe",
				"#4facfe",
				"#f093fb",
				"#6fa3ef",
				"#bc99c4",
				"#46c47c",
				"#f9bb3c",
				"#e8583d",
				"#f68e5f",
			];
			const random = (min, max) => {
				min = Math.ceil(min);
				max = Math.floor(max);
				return Math.floor(Math.random() * (max - min + 1)) + min;
			};
			$(".joe_aside__item-contain .list li").each((i, item) => {
				entries.push({
					label: $(item).attr("data-label"),
					url: $(item).attr("data-url"),
					target: "_blank",
					fontColor: colors[random(0, colors.length - 1)],
					fontSize: 15,
				});
			});
			$(".joe_aside__item-contain .tag").svg3DTagCloud({
				entries,
				width: 281,
				height: 220,
				radius: "65%",
				radiusMin: 75,
				bgDraw: false,
				fov: 800,
				speed: 0.5,
				fontWeight: 500,
			});
		}
	}

	/* 侧边栏舔狗日记 */
	{
		if ($(".joe_aside__item.flatterer").length) {
			const arr = [
				"你昨天晚上又没回我信息，我却看见你的游戏在线，在我再一次孜孜不倦的骚扰你的情况下，你终于跟我说了一句最长的话“**你他妈是不是有病**”，我又陷入了沉思，这一定有什么含义，我想了很久，你竟然提到了我的妈妈，原来你已经想得那么长远了，想和我结婚见我的父母，我太感动了，真的。那你现在在干嘛，我好想你，我妈妈说她也很喜欢你。",
				"今天我观战了一天你和别人打游戏，**你们玩的很开心**；我给你发了200多条消息，你说没流量就不回；晚上发说说没有人爱你，我连滚带爬评论了句有“我在”，你把我拉黑了，我给你打电话也无人接听。对不起，我不该打扰你，我求求你再给我一次当好友的机会吧！",
				"我爸说再敢网恋就打断我的腿，幸好不是胳膊，这样我还能继续**和你打字聊天**，就算连胳膊也打断了，我的心里也会有你位置。",
				"你说你情侣头像是一个人用的，空间上锁是因为你不喜欢玩空间，情侣空间是和闺蜜开的，找你连麦时你说你在忙工作，每次聊天你都说在忙，你真是一个**上进的好女孩**，你真好，我好喜欢你！",
				"你跟他已经醒了吧？我今天捡垃圾挣了一百多，明天给你打过去。你快点休息吧，我明天叫你起床，给你点外卖买烟，给你点你最喜欢的奶茶。晚上我会继续去摆地摊的，你不用担心我，你床只有那么大睡不下三个。**你要好好照顾好自己，不要让他抢你被子**。我永远爱你！",
				"她三天没回我的消息了，在我孜孜不倦地骚扰下她终于舍得回我“**nmsl**”，我想这一定是有什么含义吧，噢！我恍然大悟原来是**尼美舒利颗粒**，她知道我有关节炎让我吃尼美舒利颗粒，她还是关心我的，但是又不想显现的那么热情。天啊！她好高冷，我好像更喜欢她了！",
				"你想我了吧？可以回我消息了吗？我买了万通筋骨贴，你**运动一个晚上腰很疼**吧？今晚早点回家，我炖了排骨汤，我永远在家等你。",
				"昨晚你和朋友打了一晚上游戏，你破天荒的给我看了战绩，虽然我看不懂但是我相信你一定是最厉害的、最棒的。我给你发了好多消息夸你，告诉你我多崇拜你，你回了我一句“**啥B**”，我翻来覆去思考这是什么意思，Sha[傻]，噢你是说我傻，那B就是Baby的意思了吧，原来你是在叫我**傻宝**，这么宠溺的语气，我竟一时不敢相信，其实你也是喜欢我的对吧。",
				"今天我还是照常给你发消息，汇报日常工作，你终于回了我四个字：“**嗯嗯，好的。**”。你开始愿意敷衍我了，我太感动了，受宠若惊。我愿意天天给你发消息，就算你天天骂我，我也不觉得烦。",
				"你昨天晚上又没回我的消息，在我孜孜不倦的骚扰下，你终于舍得回我了，你说“**滚**”，这其中一定有什么含义，我想了很久，滚是三点水，这代表你对我的思念也如**滚滚流水**一样汹涌，我感动哭了，不知道你现在在干嘛，我很想你。",
				"听说你想要一套化妆品，我算了算，明天我去工地上**搬一天砖**，就可以拿到200块钱，再加上我上个月攒下来的零花钱，刚好给你买一套迪奥。",
				"今天表白被拒绝了，她对我说能不能脱下裤子**撒泡尿照照自己**。当我脱下裤子，她咽了口水，说我们可以试一下。",
				"刚从派出所出来，原因前几天14号情人节，我想送你礼物，我去偷东西的时候被抓了。我本来想反抗，警察说了一句老实点别动，我立刻就放弃了反抗，因为我记得你说过，你喜欢**老实人**。",
				"疫情不能出门，现在是早上八点，你肯定饿了吧。我早起做好了早餐来到你小区，保安大哥不让进。我给你打了三个电话你终于接了“**有病啊，我还睡觉呢，你小区门口等着吧**”。啊，我高兴坏了！你终于愿意吃我做的早餐了，还让我等你，啊！啊！啊！好幸福噢！",
				"我存了两个月钱，给你买了一双**北卡蓝**，你对我说一句“谢谢”，我好开心。这是你第一次对我说两个字，以前你都只对我说滚。今天晚上逛**闲鱼**，看到了你把我送你的北卡蓝发布上去了。我想你一定是在考验我，再次送给你，给你一个惊喜，我爱你。",
				"昨天**你领完红包就把我删了**，我陷入久久地沉思。我想这其中一定有什么含义，原来你是在欲擒故纵，嫌我不够爱你。无理取闹的你变得更加可爱了，我会坚守我对你的爱的。你放心好啦！今天发工资了，发了1850，给你微信转了520，支付宝1314，还剩下16。给你发了很多消息你没回。剩下16块我在小卖部买了你爱吃的老坛酸菜牛肉面，给你寄过去了。希望你保护好食欲，我去上班了爱你~~",
				"在保安亭内看完了最新一集的梨泰院，曾经多么倔强的朴世路因为伊瑞给张大熙跪下了，亭外的树也许感受到了**我的悲伤**，枯了。我连树都保护不了，怎么保护你，或许保安才是真的需要被保护的吧。我难受，我想你。over",
				"难以言喻的下午。说不想你是假的，说爱你是真的。昨天他们骂**我是你的舔狗**，我不相信，因为我知道你肯定也是爱我的，你一定是在考验我对你的感情，只要我坚持下去你一定会被我的真诚所打动，加油！不过我要批评你一下，昨晚你说**去酒店跟人斗地主**，我寻思两个人也玩不了呀。算了，不想了，毕竟打牌是赌博行为，不太好。",
				"明天就周六了我知道你不上班，但是我怕你睡懒觉不吃早饭饿坏自己。我早晨4点去菜市场买了新鲜活鸡**给你炖鸡汤**，阿姨给我用箱子装了起来，我骑上我280买的电动车哼着小调回家，心想你一定会被我感动的，箱子半路开了，鸡跑了，拐到了一个胡同里，凌晨4点的胡同还有穿超短裙和大叔聊天的美女，不禁感叹这个世界变了，她问我找什么，…………。对不起，我爱你",
				"12点队长过来准时交班，出去的车辆按喇叭我也没听到，只因我在监控中看到了穿睡衣出来倒垃圾的你，**望你望的入神**不由的傻笑了起来，队长过来骂我扣了我一天工资。我委屈，想抱你。你送的泡面真好吃。",
				"今天的我排位输了好多把，我将这些事情分享给你，但是你一个字都没有讲，我在想你是不是在忙？我头痛欲裂，终于在我给你发了几十条消息之后，你回了我一个“**脑子是不是有病？**”，原来你还是关心我的，看到这句话，我的脑子一下就不疼了，今天也是爱你的一天。",
				"我存了半年的工资，给你买了一只LV，你对我说了一句“**你真好**”，我好开心，这是你第一次这么认可我，以前你都只对我说滚。今天晚上逛闲鱼，看到你把我送你的LV发布上去了。我想，你一定是在考验我，于是我用借呗里的钱把它买了下来，再次送给你，给你一个惊喜，我爱你。",
				"其实我每月工资6000，但我只给你转2000，你以为我给你了全部。才不是，我一共舔了3个啦，**我要舔的雨露均沾**，才不会把你当成唯一。",
				"昨天你把我拉黑了，我看着红色感叹号陷入了久久的沉思，我想这其中一定有什么含义？红色红色？我明白了！红色代表热情，你对我很热情，你想和我结婚，我愿意。",
				"今天你问我借了两千块钱，说要做个手术，你果然还是爱我的，**不是我的孩子，你不要**。 ",
				"中午你无故扇了我一巴掌，我握着你的手说“手怎么这么凉，都怪我没有照顾好你，一定要更加对你好”。",
				"我给你打了几通电话，你终于接了。听到了**你发出啊啊啊啊的声音**，你说你肚子痛，我想你一定是很难受吧。电话还有个男的对你说“来换个姿势”，一定是**在做理疗**了。期待你早日康复，我好担心。",
				"昨天晚上好冷，本来以为街上没人，结果刚刚**偷电动车**的时候被抓了，本来想反抗，但警察说了一句老实点别动，我立刻就放弃了抵抗，因为我记得你说过，你喜欢**老实人**。",
				"找你连麦时你说你在忙工作，每次聊天你都说在忙，你真是一个**上进的好女孩**，你真好，发现我越来越喜欢这样优秀的你。",
				"你从来没说过爱我，聊天记录搜索了一下“爱”，唯一的一条是：**你好像乡村爱情里的刘能啊**。",
				"今天好开心啊，和你一起在峡谷嬉戏，打完一波团战之后看到你在打大龙，残血的我跳过去直接被龙爪拍死，但这一刻我觉得好浪漫，**死在你的脚旁边，这是我离你最近的一次**。",
				"哥们，求你和她说句话吧，这样她就不会那么难过了。",
				"今天你把我的微信拉黑了，这下我终于解放了！以前我总担心太多消息会打扰你，现在我终于不用顾忌，不管我怎么给你发消息，都不会让你不开心了。等我**攒够5201314条**我就拿给你看，你一定会震惊得说不出话然后哭着说会爱我一辈子。哈哈。",
				"昨天你把我删了，我陷入了久久的沉思 。我想这其中一定有什么含义，你应该是欲擒故纵吧，嫌我不够爱你。突然觉得**无理取闹的你变得更加可爱**了，我会坚守我对你的爱的 你放心好啦！这么一想，突然对我俩的未来更有期望了呢。",
				"今天上班不是太忙，百无聊赖，又翻出了你的相片，看了又看。今天是我认识你的第302天，也是我爱你的第302天，可是这些你并不知道，也许**你知道了，也不会在意**吧。 此刻的我好想你！ ",
				"今天你跟我说我很丑，让我不要骚扰你了。我听了很高兴，小说里的主角都像你这样，最开始表现的很厌恶，但最后**总会被我的真心打动**。你现在有多讨厌我，以后就会有多爱我。嘻嘻。",
				"我坐在窗边给你发了99条消息，你终于肯回我了，你说“**发你妈啊**”，我一下子就哭了。原来努力真的有用，你已经开始考虑想见我的妈妈了，你也是挺喜欢我的。",
				"刚才我找你说话，你回了一个滚，我陷入了沉思，你还是如此的关心我，知道我腿受伤了，让我这样走，好感动！看来你还是爱我的！",
				"今天下雨了，我去你公司接你下班。看见我你不耐烦的说“**烦不烦啊，不要再找我了**”，一头冲进雨里就跑开了。我心里真高兴啊，你宁愿自己淋雨，都不愿让我也淋湿一点，你果然还是爱我的。",
				"晚上和你聊天，10点钟不到，你就说“**困了，去睡觉了**”。现在凌晨1点钟，看到你给他的朋友圈点赞评论，约他明天去吃火锅，一定是你微信被盗了吧。",
				"今天我主动给你发了游戏邀请，邀请你和我单挑安琪拉，虽然我安琪拉很菜，可是为了和你打游戏，我还是毅然决然给你发了邀请。你说你不接受，你在打其他游戏。联想到我自己很菜，我突然明白，原来你还是在乎我的，只是不想一遍遍连招一套的在泉水送我走。我再一次感动哭了，因此，我好像更喜欢你了，你可真是一个宝藏男孩！",
				"你的头像是一个女孩子左手边牵着一条秋田犬，犬=狗，而**我是一条舔狗**。是不是代表你的小手在牵着我呢？",
				"今天发工资了，我一个月工资3000，你猜我会给你多少，是不是觉得我会给你2500，自己留500吃饭？你想多了，我3000都给你，因为厂里包吃包住。",
				"昨天就为你充了710点卷，虽然知道你不会玩不知去向，但你说好看，你刚才说小号想要还想要一个，爱你的我还是满心欢喜的把剩下的100元伙食费又给你充了710，然后看到你小号并没有买，而是你送给了你的一个弟弟，你对弟弟真好，好有爱心，我感觉对你陷得很深了。",
				"今天我给你发消息，你回复我“**nmsl**”，我想了半天才知道你是在夸我，原来是**你美死了**，你嘴真甜，我爱你。",
				"你说你想买口红，今天我去了叔叔的口罩厂做了一天的打包。拿到了两百块钱，加上我这几天**省下的钱刚好能给你买一根小金条**。即没有给我自己剩下一分钱，但你不用担心，因为厂里包吃包住。对了打包的时候，满脑子都是你，想着你哪天突然就接受我的橄榄枝了呢。而且今天我很棒呢，主管表扬我很能干，其实也有你的功劳啦，是你给了我无穷的力量。今天我比昨天多想你一点，比明天少想你一点。",
				"在我一如既往的每天跟她问早安的时候，她今天终于回我了。我激动地问她我是不是今天第一个跟她说话的人，她说不是，是**她男朋友把她叫起来退房**的。",
				"听说你朋友说今天出门了，我打扮成精神小伙来找你，没想到你竟然对我说“**给我爬，别过来**”我当场就哭了，原来真心真的会感动人，你一定是知道，穿豆豆鞋走路脚会很累，让我爬是因为这样不会累着脚，其实你是喜欢我的吧",
				"今天把你的备注改成了「**对方正在输入...**」，这样我就知道你不是不想回我，刚又给你发了消息，看到你在思考怎么回我，我就知道你和我一样，心里有我。",
				"今天在楼上窗户上看见你和他在公园里接吻，我看见哭了出来，并打电话给你，想问问你为什么？但你说怎么了，声音是那么好听。于是我说“**以后你和他接吻的时候，能不能用我送给你的口红啊？**”",
				"我退了无关紧要的群，唯独这个群我没有退，因为这里有一个对我来说很特别的女孩子，我们不是好友，**我每天只能通过群名片看看她**，虽然一张照片也看不到，我也知足了，我不敢说她的名字，但我知道她是群里面最美的女孩子，她说我们这样会距离产生美~ 我想想发现她说的挺对的，我心里很开心。",
				"今天早上我告诉你我想你了，你没理我。今天中午我给你打电话，你不接，打第二个你就关机。晚上我在你公司楼下等你，你对我说的第一句话就是滚“**滚，别烦我，别浪费时间了**”，我真的好感动，你居然为我考虑了，怕我浪费时间。呜呜呜，这是我爱你的第74天。",
				"我坐在窗边给你发了99条消息，你终于肯回我了你说“**发你妈啊**”，我一下子就哭了，原来努力真的有用，你已经开始考虑想见我的妈妈了，你其实也是挺喜欢我的。",
				"你一个小时没回我的消息，在我孜孜不倦地骚扰下你终于舍得回我了“**在做爱**”，这其中一定有什么含义，我想了很久，“在做爱”这简简单单的三个字肯定是三句话，分别是**我在忙、做你女朋友、我爱你**，想到这里我不禁流下了眼泪，我这么长时间的喜欢没有白费，不知道你现在忙干嘛，但我很想你。",
				"最近我暗恋的女生每天都和不同的男生约会，我想总有一天会轮到我，我问她什么时候能见见我？她说**下辈子吧**。她真好，下辈子还要和我在一起。",
				"你好像从来没有对我说过晚安，我在我们的聊天记录里搜索了关键字：“晚安”，你说过一次：**我早晚安排人弄死你**。",
			];
			const random = (min, max) => {
				min = Math.ceil(min);
				max = Math.floor(max);
				return Math.floor(Math.random() * (max - min + 1)) + min;
			};
			const toggle = () => {
				$(".joe_aside__item.flatterer .content").html(arr[random(0, arr.length - 1)].replace(
					/\*\*(.*?)\*\*/g, "<mark>$1</mark>"));
				$(".joe_aside__item.flatterer .content").attr("class", "content type" + random(1, 6));
			};
			toggle();
			$(".joe_aside__item.flatterer .change").on("click", () => toggle());
		}
	}

	/* 激活Live2d人物 */
	{
		if (Joe.LIVE2D !== "off" && Joe.LIVE2D) {
			$.getScript(`${Joe.THEME_URL}assets/plugin/live2d/L2Dwidget.min.js`, () => {
				L2Dwidget.init({
					model: {
						jsonPath: Joe.LIVE2D,
						scale: 1
					},
					mobile: {
						show: true
					},
					display: {
						position: "left",
						width: 130,
						height: 170,
						hOffset: 0,
						vOffset: 0
					},
				});
			});
		}
	}

	/* 评论框点击切换画图模式和文本模式 */
	{
		if ($(".joe_comment").length) {
			$(".joe_comment__respond-type .item").on("click", function () {
				$(this).addClass("active").siblings().removeClass("active");
				if ($(this).attr("data-type") === "draw") {
					$(".joe_comment__respond-form .body .draw").show().siblings().hide();
					$("#joe_comment_draw").prop("width", $(".joe_comment__respond-form .body").width());
					/* 设置表单格式为画图模式 */
					$(".joe_comment__respond-form").attr("data-type", "draw");
					/** 隐藏表情包功能 */
					$('.joe_comment__respond-form .foot .owo').css('opacity', '0');
				} else {
					$(".joe_comment__respond-form .body .text").show().siblings().hide();
					/* 设置表单格式为文字模式 */
					$(".joe_comment__respond-form").attr("data-type", "text");
					/** 显示表情包功能 */
					$('.joe_comment__respond-form .foot .owo').css('opacity', '1');
				}
			});
		}
	}

	/* 激活画图功能 */
	{
		if ($("#joe_comment_draw").length) {
			/* 激活画板 */
			window.sketchpad = new Sketchpad({
				element: "#joe_comment_draw",
				height: 300,
				penSize: 5,
				color: "303133"
			});
			/* 撤销上一步 */
			$(".joe_comment__respond-form .body .draw .icon-undo").on("click", () => window.sketchpad.undo());
			/* 动画预览 */
			$(".joe_comment__respond-form .body .draw .icon-animate").on("click", () => window.sketchpad
				.animate(10));
			/* 更改画板的线宽 */
			$(".joe_comment__respond-form .body .draw .line li").on("click", function () {
				window.sketchpad.penSize = $(this).attr("data-line");
				$(this).addClass("active").siblings().removeClass("active");
			});
			/* 更改画板的颜色 */
			$(".joe_comment__respond-form .body .draw .color li").on("click", function () {
				window.sketchpad.color = $(this).attr("data-color");
				$(this).addClass("active").siblings().removeClass("active");
			});
		}
	}

	/* 重写评论功能 */
	{
		if ($(".joe_comment__respond").length) {
			const respond = $(".joe_comment__respond");
			/* 重写回复功能 */
			$(".joe_comment__reply").on("click", function () {
				/* 父级ID */
				const coid = $(this).attr("data-coid");
				/* 当前的项 */
				const item = $("#" + $(this).attr("data-id"));
				/* 添加自定义属性表示父级ID */
				respond.find(".joe_comment__respond-form").attr("data-coid", coid);
				item.append(respond);
				$(".joe_comment__respond-type .item[data-type='text']").click();
				$(".joe_comment__cancle").show();
				window.scrollTo({
					top: item.offset().top - $(".joe_header").height() - 15,
					behavior: "smooth",
				});
			});
			/* 重写取消回复功能 */
			$(".joe_comment__cancle").on("click", function () {
				/* 移除自定义属性父级ID */
				respond.find(".joe_comment__respond-form").removeAttr("data-coid");
				$(".joe_comment__cancle").hide();
				$(".joe_comment>.comment-list").before(respond);
				$(".joe_comment__respond-type .item[data-type='text']").click();
				window.scrollTo({
					top: $(".joe_comment").offset().top - $(".joe_header").height() - 15,
					behavior: "smooth",
				});
			});
		}
	}

	/* 激活评论提交 */
	{
		if ($(".joe_comment").length) {
			let isSubmit = false;
			$(".joe_comment__respond-form").on("submit", function (e) {
				e.preventDefault();
				const action = $(".joe_comment__respond-form").attr("action") + "?time=" + +new Date();
				const type = $(".joe_comment__respond-form").attr("data-type");
				const parent = $(".joe_comment__respond-form").attr("data-coid");
				const author = $(".joe_comment__respond-form .head input[name='author']").val();
				const _ = $(".joe_comment__respond-form input[name='_']").val();
				const mail = $(".joe_comment__respond-form .head input[name='mail']").val();
				const url = $(".joe_comment__respond-form .head input[name='url']").val();
				let text = $(".joe_comment__respond-form .body textarea[name='text']").val();
				if (author.trim() === "") return Qmsg.info("请输入昵称！");
				if (!/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test(mail)) return Qmsg.info(
					"请输入正确的邮箱！");
				if (type === "text" && text.trim() === "") return Qmsg.info("请输入评论内容！");
				if (type === "draw") {
					const txt = $("#joe_comment_draw")[0].toDataURL("image/webp", 0.1);
					text = "{!{" + txt + "}!} ";
				}
				if (isSubmit) return;
				isSubmit = true;
				$(".joe_comment__respond-form .foot .submit button").html("发送中...");
				$.ajax({
					url: action,
					type: "POST",
					data: {
						author,
						mail,
						text,
						parent,
						url,
						_
					},
					dataType: "text",
					success(res) {
						let arr = [],
							str = "";
						arr = $(res).contents();
						Array.from(arr).forEach((_) => {
							if (_.parentNode.className === "container") str = _;
						});
						if (!/Joe/.test(res)) {
							Qmsg.warning(str.textContent.trim() || "");
							isSubmit = false;
							$(".joe_comment__respond-form .foot .submit button").html("发表评论");
						} else {
							window.location.reload();
						}
					},
					error(res) {
						isSubmit = false;
						$(".joe_comment__respond-form .foot .submit button").html("发表评论");
						res = res.responseText;
						var str = /<div class="container">\s+(.+)\s+<\/div>/;
						var msg = res.match(str)[1];
						if (msg) {
							Qmsg.warning(msg);
						} else {
							Qmsg.warning("发送失败！请刷新重试！");
						}
					},
				});
			});
		}
	}

	/* 设置评论回复网址为新窗口打开 */
	{
		$(".comment-list__item .term .content .user .author a").each((index, item) => $(item).attr("target",
			"_blank"));
	}

	/* 格式化评论分页的hash值 */
	{
		$(".joe_comment .joe_pagination a").each((index, item) => {
			const href = $(item).attr("href");
			if (href && href.includes("#")) {
				$(item).attr("href", href.replace("#comments", "?scroll=joe_comment"));
			}
		});
	}

	/* 切换标签显示不同的标题 */
	{
		if (Joe.DOCUMENT_TITLE) {
			const TITLE = document.title;
			document.addEventListener("visibilitychange", () => {
				if (document.visibilityState === "hidden") {
					document.title = Joe.DOCUMENT_TITLE;
				} else {
					document.title = TITLE;
				}
			});
		}
	}

	{
		$('body').on('click', '[data-toggle-class]', function () {
			var c = $(this).attr('data-toggle-class') || 'show';
			var e = $(this).attr('data-target') || this;
			return $(e).toggleClass(c).trigger('toggleClass'), !1;
		});
	}

	/* 小屏幕伸缩侧边栏 */
	{
		$(".joe_header__above-slideicon").on("click", function () {
			/* 关闭搜索框 */
			$(".joe_header__searchout").removeClass("active");
			/* 处理开启关闭状态 */
			if ($(".joe_header__slideout").hasClass("active")) {
				$("body").css("overflow", "");
				$('body').addClass('mobile-navbar-show');
				$(".joe_header__mask").removeClass("active slideout");
				$(".joe_header__slideout").removeClass("active");
				$('.joe_header__above').css('box-shadow', '');
			} else {
				$("body").css("overflow", "hidden");
				$('body').removeClass('mobile-navbar-show');
				$(".joe_header__mask").addClass("active slideout");
				$(".joe_header__slideout").addClass("active");
				$('.joe_header__above').css('box-shadow', '0 10px 10px var(--main-shadow)');
			}
		});
	}

	/* 小屏幕搜索框 */
	{
		$(".joe_header__above-searchicon").on("click", function () {
			/* 关闭侧边栏 */
			$(".joe_header__slideout").removeClass("active");
			$('.joe_header__above').css('box-shadow', '');
			$('body').removeClass('mobile-navbar-show');
			/* 处理开启关闭状态 */
			if ($(".joe_header__searchout").hasClass("active")) {
				$("body").css("overflow", "");
				$(".joe_header__mask").removeClass("active slideout");
				$(".joe_header__searchout").removeClass("active");
			} else {
				$("body").css("overflow", "hidden");
				$(".joe_header__mask").addClass("active");
				$(".joe_header__searchout").addClass("active");
			}
		});
	}

	/* 点击遮罩层关闭 */
	{
		$(".joe_header__mask").on("click", function () {
			$("body").css("overflow", "");
			$('body').removeClass('mobile-navbar-show');
			$(".joe_header__mask").removeClass("active slideout");
			$(".joe_header__searchout").removeClass("active");
			$(".joe_header__slideout").removeClass("active");
			$('.joe_header__above').css('box-shadow', '');
		});
	}

	/* 移动端侧边栏菜单手风琴 */
	{
		$(".joe_header__slideout-menu .current").parents(".panel-body").show().siblings(".panel").addClass(
			"in");
		$(".joe_header__slideout-menu .panel").on("click", function () {
			const panelBox = $(this).parent().parent();
			/* 清除全部内容 */
			panelBox.find(".panel").not($(this)).removeClass("in");
			panelBox.find(".panel-body").not($(this).siblings(".panel-body")).stop().hide("fast");
			/* 激活当前的内容 */
			$(this).toggleClass("in").siblings(".panel-body").stop().toggle("fast");
		});
	}

	/* 初始化网站运行时间 */
	{
		const getRunTime = () => {
			const birthDay = new Date(Joe.BIRTHDAY);
			const today = +new Date();
			const timePast = today - birthDay.getTime();
			let day = timePast / (1000 * 24 * 60 * 60);
			let dayPast = Math.floor(day);
			let hour = (day - dayPast) * 24;
			let hourPast = Math.floor(hour);
			let minute = (hour - hourPast) * 60;
			let minutePast = Math.floor(minute);
			let second = (minute - minutePast) * 60;
			let secondPast = Math.floor(second);
			day = String(dayPast).padStart(2, 0);
			hour = String(hourPast).padStart(2, 0);
			minute = String(minutePast).padStart(2, 0);
			second = String(secondPast).padStart(2, 0);
			$(".joe_run__day").html(day);
			$(".joe_run__hour").html(hour);
			$(".joe_run__minute").html(minute);
			$(".joe_run__second").html(second);
		};
		if (Joe.BIRTHDAY && /(\d{4})\/(\d{1,2})\/(\d{1,2}) (\d{1,2})\:(\d{1,2})\:(\d{1,2})/.test(Joe
			.BIRTHDAY)) {
			getRunTime();
			setInterval(getRunTime, 1000);
		}
	}

	/* 初始化表情功能 */
	{
		if ($(".joe_owo__contain").length && $(".joe_owo__target").length && !$('.joe_owo__target').attr('disabled')) {
			var OwOUrl = $('.joe_owo__contain').attr('data-url') || window.Joe.THEME_URL;
			$.ajax({
				url: window.Joe.THEME_URL + "assets/json/joe.owo.json",
				dataType: "json",
				success(res) {
					let barStr = "";
					let scrollStr = "";
					for (let key in res) {
						const item = res[key];
						key = key.replace('表情', '');
						barStr += `<div class="item" data-type="${key}">${key}</div>`;
						scrollStr += `
						<ul class="scroll" data-type="${key}">
							${item.map((_) => {
								if (key == '颜文字' || key == 'emoji') {
									return `<li data-toggle="tooltip" data-original-title="${_.text}" class="item" data-text="${_.icon}">${_.icon}</li>`;
								} else {
									let title = /.*?\((.*?)\)/.exec(_.text)[1];
									return `<li data-toggle="tooltip" data-original-title="${title}" class="item" data-text="${_.text}"><img class="lazyload" src="${window.Joe.LAZY_LOAD}" data-src="${OwOUrl + _.icon}" title="${title}" alt="${title}"/></li>`;
								}
							}).join("")}
						</ul>`;
					}
					$(".joe_owo__contain").html(`
						<div class="seat">OωO</div>
						<div class="box">
							${scrollStr}
							<div class="bar no-scrollbar">${barStr}</div>
						</div>
					`);
					window.Joe.tooltip();
					$(document).on("click", function () {
						$(".joe_owo__contain .box").stop().slideUp("fast");
					});
					$(".joe_owo__contain .seat").on("click", function (e) {
						e.stopPropagation();
						$(this).siblings(".box").stop().slideToggle("fast");
					});
					$(".joe_owo__contain .box .bar .item").on("click", function (e) {
						e.stopPropagation();
						$(this).addClass("active").siblings().removeClass("active");
						const scrollIndx = '.joe_owo__contain .box .scroll[data-type="' + $(
							this).attr("data-type") + '"]';
						$(scrollIndx).show().siblings(".scroll").hide();
					});
					$(".joe_owo__contain .scroll .item").on("click", function () {
						const text = $(this).attr("data-text");
						$(".joe_owo__target").insertContent(text);
					});
					$(".joe_owo__contain .box .bar .item").first().click();
				},
			});
		}
	}

	/* 座右铭 */
	{
		const mottoArray = [
			'风急天高猿啸哀，渚清沙白鸟飞回',
			'无边落木萧萧下，不尽长江滚滚来',
			'万里悲秋常作客，百年多病独登台',
			'艰难苦恨繁霜鬓，潦倒新停浊酒杯',
			'君不见黄河之水天上来，奔流到海不复回',
			'君不见高堂明镜悲白发，朝如青丝暮成雪',
			'人生得意须尽欢，莫使金樽空对月',
			'天生我材必有用，千金散尽还复来',
			'问君能有几多愁，恰似一江春水向东流',
			'不知天上宫阙，今夕是何年',
			'我欲乘风归去，又恐琼楼玉宇',
			'高处不胜寒，起舞弄清影，何似在人间',
			'醉里挑灯看剑，梦回吹角连营',
			'八百里分麾下炙，五十弦翻塞外声，沙场秋点兵',
			'在天愿为比翼鸟，在地愿为连理枝',
			'莫愁前路无知己，天下谁人不识君',
			'枯藤老树昏鸦，小桥流水人家',
			'夕阳西下，断肠人在天涯',
			'安能摧眉折腰事权贵，使我不得开心颜？',
			'国破山河在，城春草木深',
			'感时花溅泪，恨别鸟惊心',
			'羌管悠悠霜满地，人不寐，将军白发征夫泪',
			'五花马，千金裘，呼儿将出换美酒',
			'山无陵，江水为竭，冬雷震震，夏雨雪，天地合，乃敢与君绝',
			'劝君更尽一杯酒,西出阳关无故人',
			'人生自是有情痴，此恨不关风与月',
			'千山鸟飞绝，万径人踪灭',
			'孤舟蓑笠翁，独钓寒江雪',
			'十年生死两茫茫，不思量，自难忘。千里孤坟，无处话凄凉',
			'纵使相逢应不识，尘满面，鬓如霜',
			'少年不识愁滋味，爱上层楼。爱上层楼，为赋新词强说愁',
			'时光只解催人老，不信多情，长恨离亭，泪滴春衫酒易醒',
			'梧桐昨夜西风急，淡月胧明，好梦频惊，何处高楼雁一声？',
			'惶恐滩头说惶恐，零丁洋里叹零丁',
			'人生自古谁无死？留取丹心照汗青',
			'前不见古人，后不见来者',
			'念天地之悠悠，独怆然而涕下',
			'我醉欲眠卿且去，明朝有意抱琴来',
			'人生自古谁无死，留取丹心照汗青',
			'黑云压城城欲摧，甲光向日金鳞开'
		];
		let motto = mottoArray[Math.floor(Math.random() * mottoArray.length)];
		$(".joe_motto").html(motto);
		if (Joe.MOTTO) {
			if (Joe.MOTTO.startsWith("https://") || Joe.MOTTO.startsWith("http://") || Joe.MOTTO.startsWith("//")) {
				$.ajax({
					url: Joe.MOTTO,
					dataType: "text",
					success: (res) => {
						$(".joe_motto").html(res);
					}
				});
			} else {
				$(".joe_motto").html(Joe.MOTTO);
			}
		}
	}

	/** 页面滚动监听函数 */
	{
		const headerAbove = document.querySelector('.joe_header__above');
		if (!window.Joe.IS_MOBILE) {
			var flag = true;
			function handleHeader(diffY) {
				if (window.pageYOffset >= $(".joe_header").height() && diffY <= 0) {
					if (flag) return;
					if (headerAbove) {
						$(".joe_header").addClass("active");
						$(".joe_aside .joe_aside__item:last-child").css("top", $(".joe_header").height() - 60 + 23);
					} else {
						$(".joe_aside .joe_aside__item:last-child").css("top", $(".joe_header").height() + 25);
					}
					flag = true;
				} else {
					if (!flag) return;
					if (headerAbove) {
						$(".joe_header").removeClass("active");
						$(".joe_aside .joe_aside__item:last-child").css("top", $(".joe_header").height() + 23);
					} else {
						$(".joe_aside .joe_aside__item:last-child").css("top", $(".joe_header").height() + 25);
					}
					flag = false;
				}
			};
			var Y = window.pageYOffset;
			handleHeader(Y);

			var lastPostNav = $(".joe_aside .joe_aside__item.posts-nav-box:last");
			if (lastPostNav.length > 0) {
				var lastPostNavHeight = lastPostNav.height();
				lastPostNav.hide();
				var asideHeight = 0;
				$('.joe_aside .joe_aside__item').each(function (index, element) {
					// console.log($(element).outerHeight())
					asideHeight += $(element).height();
				});
				asideHeight = (asideHeight - lastPostNavHeight) - $(".joe_header").height();
			}
		}
		$(window).scroll(throttle(() => {
			// 激活全局返回顶部功能
			var h = document.documentElement.scrollTop + document.body.scrollTop;
			var ontop = $(".joe_action_item.scroll");
			h > 100 ? $('body').addClass('body-scroll') : $('body').removeClass('body-scroll');
			h > 400 ? ontop.addClass('active') : ontop.removeClass('active');

			// 头部滚动
			if (!window.Joe.IS_MOBILE) {
				if (lastPostNav.length > 0) {
					if (h > asideHeight && lastPostNav.is(":hidden")) {
						lastPostNav.fadeIn('slow');
					}
					if (h < asideHeight && lastPostNav.is(":visible")) {
						lastPostNav.fadeOut('slow');
					}
				}
				handleHeader(Y - window.pageYOffset);
				Y = window.pageYOffset;
			}
		}, 100))//.trigger("scroll");

		// 页面滚动隐藏 tooltip 提示
		$(window).scroll(debounce(() => {
			if (!Joe.IS_MOBILE) $("[data-toggle='tooltip']").tooltip('hide');
		}, 500, true));
	}

	/* 监听移动端键盘弹出 */
	{
		var footerTabbar = document.querySelector('.footer-tabbar');
		var joeAction = document.querySelector('.joe_action');
		if (footerTabbar || joeAction) {
			const ua = typeof window === 'object' ? window.navigator.userAgent : '';
			let _isIOS = -1;
			let _isAndroid = -1;
			const isIOS = () => {
				if (_isIOS === -1) {
					_isIOS = /iPhone|iPod|iPad/i.test(ua) ? 1 : 0;
				}
				return _isIOS === 1;
			}
			const isAndroid = () => {
				if (_isAndroid === -1) {
					_isAndroid = /Android/i.test(ua) ? 1 : 0;
				}
				return _isAndroid === 1;
			}
			const popUp = () => {
				if (footerTabbar) footerTabbar.style.display = 'none';
				if (joeAction) joeAction.style.display = 'none';
			}
			const retract = () => {
				if (footerTabbar) footerTabbar.style.display = 'flex';
				if (joeAction) joeAction.style.display = 'block';
			}
			if (isAndroid()) {
				const innerHeight = window.innerHeight;
				window.addEventListener('resize', () => {
					const newInnerHeight = window.innerHeight;
					if (innerHeight > newInnerHeight) {
						// 键盘弹出事件处理
						popUp();
					} else {
						// 键盘收起事件处理
						retract();
					}
				});
			} else if (isIOS()) {
				window.addEventListener('focusin', () => {
					// 键盘弹出事件处理
					popUp();
				});
				window.addEventListener('focusout', () => {
					// 键盘收起事件处理
					retract();
				});
			}
		}
	}

	/** 动态监听实际VH高度 */
	{
		if (window.Joe.IS_MOBILE) {
			function resetVhAndPx() {
				let vh = window.innerHeight * 0.01
				document.documentElement.style.setProperty('--vh', `${vh}px`)
				// document.documentElement.style.fontSize = document.documentElement.clientWidth / 375 + 'px'
				console.log('重新计算VH高度')
			}
			resetVhAndPx();
			// 监听resize事件 视图大小发生变化就重新计算1vh的值
			window.addEventListener('resize', resetVhAndPx);
		}
	}

	/** 文章列表缩略图加载失败自动使用主题自带缩略图 */
	{
		window.thumbOnError = function () {
			$('img.error-thumbnail').on('error', function () {
				if (!this.dataset.thumbnailLoaded) {
					// 生成一个 1 到 42 之间的随机整数
					const randomNumber = Math.floor(Math.random() * 41) + 1;
					// 将随机数格式化为两位数
					const formattedNumber = ("0" + randomNumber).slice(-2);
					const thumb = `${Joe.THEME_URL}assets/images/thumb/${formattedNumber}.jpg`;
					$(this).attr('data-src', thumb);
					$(this).attr('src', thumb);
					this.dataset.thumbnailLoaded = true;
				}
			});
		}
		thumbOnError();
	}

	/** 头像加载失败代替 */
	{
		window.avatarOnError = () => {
			$('img.avatar').on('error', function () {
				if (!this.dataset.defaultAvatarLoaded) {
					this.setAttribute('data-src', Joe.THEME_URL + 'assets/images/avatar-default.png');
					this.setAttribute('src', Joe.THEME_URL + 'assets/images/avatar-default.png');
					this.dataset.defaultAvatarLoaded = true;
				}
			});
		}
		avatarOnError();
	}

	/** 模态框 */
	{
		var _wid = $(window).width();
		var _hei = $(window).height();
		// 模态框居中
		$('body').on('show.bs.modal loaded.bs.modal', '.modal:not(.flex)', function () {
			var o = $(this);
			var i = o.find('.modal-dialog');
			o.css('display', 'block'),
				i.css({
					'margin-top': Math.max(0, (_hei - i.height()) / 2),
				});
		});

		// 每次都刷新的模态框
		$('body').on('click', '[data-toggle="RefreshModal"]', function () {
			var _this = $(this);
			var dataclass = _this.attr('data-class') || '';
			var remote = _this.attr('data-remote');
			var height = _this.attr('data-height') || 300;
			var mobile_bottom = _this.attr('mobile-bottom') && _wid < 769 ? ' bottom' : '';
			var modal_class = 'modal flex jc fade' + mobile_bottom;
			var id = 'refresh_modal';
			var is_new = _this.attr('new');
			id += is_new ? parseInt((Math.random() + 1) * Math.pow(10, 4)) : '';

			var _id = '#' + id;

			dataclass += ' modal-dialog';
			var modal_html =
				'<div class="' +
				modal_class +
				'" id="' +
				id +
				'" tabindex="-1" role="dialog" aria-hidden="false">\
	<div class="' +
				dataclass +
				'" role="document">\
	<div class="modal-content">\
	</div>\
	</div>\
	</div>';

			var loading = '<div class="modal-body" style="display:none;"></div><div class="flex jc loading-mask absolute main-bg radius8"><div class="em2x opacity5"><i class="loading"></i></div></div>';
			// console.log(_id);
			var _modal = $(_id);
			if (_modal.length) {
				if (_modal.hasClass('in')) modal_class += ' in';
				_modal.removeClass().addClass(modal_class);
				_modal.find('.modal-dialog').removeClass().addClass(dataclass);
				_modal.find('.loading-mask').fadeIn(200);
				_modal
					.find('.modal-content')
					.css({
						overflow: 'hidden',
					})
					.animate({
						height: height,
					});
			} else {
				$('body').append(modal_html);
				_modal = $(_id);
				if (is_new) {
					_modal.on('hidden.bs.modal', function () {
						$(this).remove();
					});
				}
				_modal.find('.modal-content').html(loading).css({
					height: height,
					overflow: 'hidden',
				});
				if (_wid < 769) {
					_modal.minitouch({
						direction: 'bottom',
						selector: '.modal-dialog',
						start_selector: '.modal-colorful-header,.touch-close,.touch',
						onEnd: function () {
							_modal.modal('hide');
						},
						stop: function () {
							return !_modal.hasClass('bottom');
						},
					});
				}
			}

			_modal.find('.touch-close').remove();
			var touch_close = '<div class="touch-close"></div>';
			if (mobile_bottom && !_this.attr('no-touch')) {
				_modal.find('.modal-dialog').append(touch_close);
			}

			_modal.modal('show');

			$.get(remote, null, function (data) {
				try {
					jsonData = JSON.parse(data);
					if (jsonData) {
						Qmsg.error(jsonData.message);
						_modal.modal('hide');
						return;
					}
				} catch (e) {
					// console.log(data);
					_modal
						.find('.modal-body')
						.html(data)
						.slideDown(200, function () {
							_modal.trigger('loaded.bs.modal').find('.loading-mask').fadeOut(200);
							var b_height = $(this).outerHeight();
							_modal.find('.modal-content').animate(
								{
									height: b_height,
								},
								200,
								'swing',
								function () {
									_modal.find('.modal-content').css({
										height: '',
										overflow: '',
										transition: '',
									});
								}
							);
						});
				}
			});
			return false;
		});
	}

	{
		//搜索多选择
		$('body').on('click', '[data-for]', function () {
			var _this = $(this);
			var _tt;
			var _for = _this.attr('data-for');
			var _f = _this.parents('form');
			var _v = _this.attr('data-value');
			var multiple = _this.attr('data-multiple');
			var _group = _this.closest('[for-group]');
			if (!_group.length) {
				_group = _this.parent();
			}

			if (multiple) {
				_tt = '';
				var active_array = [];
				var _input = '';
				var is_active = _this.hasClass('active');
				if (!is_active) {
					//添加
					if (_group.find('[data-for="_for"].active').length >= multiple) {
						return Qmsg.info('最多可选择' + multiple + '个', 'danger');
					}
				}

				if (is_active) {
					//已存在-删除
					_group.find('[data-for="' + _for + '"][data-value="' + _v + '"]').removeClass('active');
				} else {
					//不存在-添加
					_group.find('[data-for="' + _for + '"][data-value="' + _v + '"]').addClass('active');
				}

				_group.find('[data-for="' + _for + '"].active').each(function () {
					var _this_value = $(this).attr('data-value');
					//不重复
					if (active_array.indexOf(_this_value) == -1) {
						_tt += $(this).html();
						_input += '<input type="hidden" name="' + _for + '[]" value="' + _this_value + '">';
						active_array.push(_this_value);
					}
				});

				//循环将所有的active_array添加active的calass
				$.each(active_array, function (index, value) {
					_group.find('[data-for="' + _for + '"][data-value="' + value + '"]').addClass('active');
				});

				_f.find("input[name='" + _for + "[]']").remove();
				_f.append(_input);
			} else {
				_group.find('[data-for="' + _for + '"]').removeClass('active');
				_group.find('[data-for="' + _for + '"][data-value="' + _v + '"]').addClass('active');

				_tt = _this.html();
				_f.find("input[name='" + _for + "']")
					.val(_v)
					.trigger('change');
			}

			_f.find("span[name='" + _for + "']").html(_tt);
			_f.find('input[name=s]').focus();
		});
	}

	{
		// tooltip.js
		window.Joe.tooltip();
		// popover.js
		$("[data-toggle='popover']").popover({
			sanitize: false,
		});
	}

	/** 全局Loading动画补全 */
	if (window.Joe.LoadingAnimation) {
		window.Joe.loadingEnd();
		function checkUrl(string) {
			try {
				// console.log(string);
				if (string.startsWith('/')) return true;
				let url = new URL(string);
				if (url.protocol == 'javascript:' || url.protocol == 'javascript::' || url.search != '') return false;
			} catch (error) {
				return false;
			}
			return true;
		}
		if (window.Joe.loadingEnd && window.Joe.loadingStart) {
			window.Joe.offLoading = () => {
				// a标签加载动画
				$(document.querySelectorAll('a[href]:not([href=""])')).click(function (e) {
					if ($(this).attr('target') == '_blank') return true;
					if ($(this).attr('ajax-replace')) return true;
					let url = $(this).attr('href');
					if (checkUrl(url)) window.Joe.loadingStart();
					setTimeout(() => {
						window.Joe.loadingEnd();
					}, 5000);
					window.addEventListener('unload', function (event) {
						// 在这里执行你希望在用户离开前运行的代码
						window.Joe.loadingEnd();
					});
				});
			}
			window.Joe.offLoading();
		}
	}
});