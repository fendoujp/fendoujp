/******
 * const defination
 * @prefix REG_ defines regular expressions const
 * @prefix TAG_ defines variables which used in the internal program  
 */

var REG_ACCOUNT = new RegExp('^[a-zA-Z]\\w{5,15}$');
var REG_PASSWORD = new RegExp('^\\S{6,20}$');
var REG_DATE = new RegExp('^\\d{4}[-]{1}\\d{2}[-]{1}\\d{2}$');
var REG_IMAGE_TYPE = new RegExp('^image/png|image/jpg|image/jpeg$');

var BROWSER_FIREFOX =  /firefox/.test(navigator.userAgent.toLowerCase());
var BROWSER_SAFARI =  /safari/.test(navigator.userAgent.toLowerCase());
var BROWSER_IE =  /mozilla/.test(navigator.userAgent.toLowerCase()) && !BROWSER_FIREFOX;
var BROWSER_CHROME =  /chrome/.test(navigator.userAgent.toLowerCase()) && !BROWSER_FIREFOX;
var IPAD =  /ipad/.test(navigator.userAgent.toLowerCase()) && !BROWSER_FIREFOX;
var iphone =  /iphone/.test(navigator.userAgent.toLowerCase()) && !BROWSER_FIREFOX;

//var base_url = $('meta[name="url"]').attr('content') + 'index.php/';
base_url = $('meta[name="url"]').attr('content');
var TAG_ERROR_FLAG = 'error_';
var TAG_SUCCESS_FLAG = 'success_';
var IMG_LOADING = base_url + 'assets/img/loading55x55.gif';
var HTML_LOADING = '<i class="fa fa-spin fa-spinner"></i> ';
var HTML_DEL = '<i class="fa fa-trash-o"></i>';
var HTML_UPLOAD = '<i class="fa fa-upload"></i>';
var HTML_EDIT = '<i class="fa fa-edit"></i>';
var HTML_ENTER = '<br />';

var TAG_UPDATE = 'action_operate_update';
var TAG_CREATE = 'action_operate_create';
var TAG_DELETE = 'action_operate_delete';

(function($){
	var methods = {
		/**
		 * display dom as block 
		 */
		/**
		 * display dom or not 
		 */
		display : function(a) {
			if(typeof a == 'undefined') a == 'block';
			this.css('display', a);
		},
		visible : function(bool) {
			this.css('visibility', bool ? 'visible' : 'hidden');
		},
		//set or get img property src
		src : function(src) {
			if(typeof src === 'undefined') return this.attr('src');
			this.attr('src', src);
		},
		//find the property of the node which specified by prefix 'data-'
		key : function(key, val) {
			if(typeof val === 'undefined') {
				return this.attr('data-' + key);
			} else {
				this.attr('data-' + key, val);
			}
		},
		disabled : function(b) {
			if(b) {
				this.attr('disabled', true);
			} else {
				this.removeAttr('disabled');
			}
			
			return this;
		},
		loading : function(o) {
			if(o == 1) {
				this.html(HTML_LOADING);
				this.disabled();
				return;				
			}
			var type = this[0].tagName.toLowerCase();
			if(type == 'button') {
				this.html(HTML_LOADING + this.html());
				this.disabled();
			} else {
				this.addClass('fa-spin');
				this.addClass('fa-spinner');
			}
		},
		complete : function(o) {
			if(o == 1) {
				this.disabled(false);
				return this;				
			}
			var type = this[0].tagName.toLowerCase();
			if(type == 'button') {
				this.html(this.html().replace(HTML_LOADING, ''));
				this.disabled(false);
			} else {
				this.removeClass('fa-spin');
				this.removeClass('fa-spinner');
			}
			
			return this;
		},
		move : function(direction, distance) {
			if('top' == direction) {
				this.css('transform', 'translate(0, ' + distance + ')');
				this.css('-webkit-transform', 'translate(0, ' + distance + ')');
			}
		},
		// not used
		valCheck : function(params) {
			var parent = this.parent().hasClass('form-group') ? this.parent() : this.parent().parent();
			if(typeof params === 'undefined') params = {};
			var callback = params.callback ? params.callback : function() {};
			var errorMessageSelector = params.errorMessageSelector ? params.errorMessageSelector : parent.next();
			var errorMessage = params.errorMessage ? params.errorMessage : false;
			var reg = params.reg ? params.reg : false;
			var val = $.trim(this.val());
			if(!val.empty()) {
				if(reg) {
					if(reg.test(val)) {
						callback();
						this.popover('hide');
						return val;
					}
				} else {
					callback();
					this.popover('hide');
					return val;
				}
			}
			
			submitCancel();
			parent.addClass('has-error');
			if(errorMessage) {
				$(errorMessageSelector).block();
				$(errorMessageSelector).text(errorMessage);
			}
			callback();
			return false;
		}
	};
	$.fn.extend(methods);
	/**
	 * find the position of the array which specified by parameter val
 	 * @param {Object} val
	 */
	Array.prototype.indexOf = function(val) {
	    for (var i = 0; i < this.length; i++) {
	        if (this[i] == val) return i;
	    }
	    return -1;
	};
	/**
	 * unset the value form the array
 	 * @param {Object} val
	 */
	Array.prototype.unset = function(val) {
	    var index = this.indexOf(val);
	    if (index > -1) {
	        this.splice(index, 1);
	    }
	};
	/**
	 * if the string is empty 
	 */
	String.prototype.empty = function() {
		if(this == '' || this == undefined || this == 'undefined' || !this) return true;
		return false;
	};
	String.prototype.format = function(data) {
		var fmt = this;
			for(var i = 0; i < data.length; i++){
				var reg = new RegExp('%' + i, 'g'),
				//var reg = '%' + i;
					//str = String(data[i]).replace(/%/g, '\\%\\');
				fmt = fmt.replace(reg, data[i]);
			}
		return fmt;
		//return fmt.replace(/\\%\\/g, '%');
	};
})(jQuery);

/**
 * execute function atfer a while, if not specified,
 * delay ususlly being 1500 
 * 
 * @param {function} fn Must be specified
 * @param {int} delay
 */
function later(fn, delay) {
	if(typeof delay === 'undefined') delay = 1500;
	setTimeout(fn, delay);
}
function ready(action) {
	$(document).ready(action);
}
//while the document is loaded, the following function will be executed
ready(function(){
  initialComponent();
});

function initialComponent() {
	initialTooltip();
	initialPopover();
	initialDatepicker();
	initialCheckbox();
	initialRadio();
	initialUpload();
	initialDropdown();
	initialSearch();
}

function initialSearch() {
	$('form[name="search"]').on('submit', function(event){
		event.preventDefault();
		var _this = this;
		submitWaiting({
			text : '正在搜索..',
			form : _this
		});
        var url = base_url + $(this).key('url');
	    var keyword = $('form[name="search"]').find('input').val();
	    request({
	        url : url,
	        params : {
	            search : keyword
	        }
	    });
	});
}

function initialDropdown() {
	$('.dropdown').each(function(){
		
		var _this = this;
		var button = $(this).find('button');
		$(this).find('li').click(function(){
			button.find('span').text($(this).text());
			button.val($(this).key('value'));
			if(!$(_this).hasClass('select')) {
				$(_this).find('.fa').removeClass('fa-caret-down').loading(1);
				page(1);
			}
		});
		if(!$(this).hasClass('select')) {
			var value = button.val() || '0';
			var text = $(this).find('li[data-value="' + value + '"]').text();;
			button.find('span').text(text);
		}
	});
}
function initialUpload() {
	$('[data-type="upload"]').each(function(){
		var _this = this;
		var file = $(this).find('input[type="file"]');
		var text = $(this).find('input[type="text"]');
		var img = $(this).key('img');
		var type = $(this).key('upload-type');
		file.unbind('change');
		file.bind('change', function(){
			
			if(type == 'item_intro_img'){
				$(this).parents('td').find('input[id^="change"]').val(1);				
			}
			
			text.val(file[0].files[0].name);
			$(_this).find('.fa').removeClass('fa-upload').loading();
			upload({
				input : file[0],
				type : type,
				callback : function(res) {
					$(_this).find('.fa').complete().addClass('fa-upload');
					if(res.indexOf(TAG_SUCCESS_FLAG) > -1) {
						if(type == 'item_zip'){
							$(img).val(res.replace(TAG_SUCCESS_FLAG, ''));
						}else{
							$(img).src(res.replace(TAG_SUCCESS_FLAG, ''));
							$(img).key('changed', '1');
						}
						msgBox({
							text : '上传成功！',
							type : 'success'
						});
					} else {
						msgBox({
							text : '上传失败！',
							type : 'error'
						});
					}
					file[0].value = '';
				}
			});
		});
	});
}

function encode(url) {
	return encodeURIComponent(url);
}

function initialTooltip() {
	if(typeof el == 'undefined') el = document.body;
	$(el).find('[data-toggle=tooltip]').tooltip();
}

function initialPopover() {
	$('[data-toggle=popover]').popover();
}

function initialDatepicker() {
	$('[data-type="date"]').datepicker({dateFormat: 'yy-mm-dd', zIndex : 10000});
  $('[data-type="date"]').attr('placeholder', 'yyyy-mm-dd');
}

function initialCheckbox(el) {
	if(typeof el == 'undefined') el = document.body;
	$(el).find('[data-type="checkbox"]').click(function(){
		var group = $(this).key('group');
  	if($(this).key('checked') != 'true') {
  		$(this).removeClass('fa-square-o').addClass('fa-check-square-o');
  		$(this).key('checked', 'true');
  	} else {
  		$(this).removeClass('fa-check-square-o').addClass('fa-square-o');
  		$(this).key('checked', 'false');
  		$('[data-type="checkAll"][data-group="' + group + '"]').removeClass('fa-check-square-o').addClass('fa-square-o');
  		$('[data-type="checkAll"][data-group="' + group + '"]').key('checked', 'false');
  	}
  });
	$(el).find('[data-type="checkAll"]').click(function(){
		var group = $(this).key('group');
  	if($(this).key('checked') != 'true') {
  		$(this).removeClass('fa-square-o').addClass('fa-check-square-o');
  		$(this).key('checked', 'true');
  		$('[data-group="' + group + '"]').removeClass('fa-square-o').addClass('fa-check-square-o');
  		$('[data-group="' + group + '"]').key('checked', 'true');
  	} else {
  		$(this).removeClass('fa-check-square-o').addClass('fa-square-o');
  		$(this).key('checked', 'false');
  		$('[data-group="' + group + '"]').removeClass('fa-check-square-o').addClass('fa-square-o');
  		$('[data-group="' + group + '"]').key('checked', 'false');
  	}
  });
}

function initialRadio(el) {
	if(typeof el == 'undefined') el = document.body;
	$(el).find('[data-type="radio"]').click(function(){
  	var group = $(this).key('group');
  	$('[data-group="' + group + '"]').removeClass('fa-check-circle-o').addClass('fa-circle-o').key('checked', 'false');
		$(this).removeClass('fa-circle-o').addClass('fa-check-circle-o');
		$(this).key('checked', 'true');
  });
}

/**
 * set the page & components in loading status
 *  
 * @param {Object} params json data
 * @param {string} button the button, which will be in loading status
 * @param {string} form the components of the specified form, 
 * 				   will be disabled, if not specified, the whole components of
 * 				   the page will be disabled
 * @param {string} html loading informations of the button
 * 
 */
function submitWaiting(params) {
	if(typeof params === 'undefined') params = {};
	var button = params.button ? params.button : '[data-action=submit]';
	var form = params.form ? params.form : document.body;
	var text = params.text ? params.text : '正在提交...';
	var html = params.html ? params.html : '<i class="fa fa-spin fa-spinner"></i> <span>' + text + '</span>';
	var modal = params.modal ? params.modal : 'modal-none';
	
	$(form).find(button).html(html);
	$(form).find(button).attr('disabled', 'true');
	$(form).find(button).key('loading', '1');
	$(form).find('input').attr('disabled', 'true');
	$(form).find('button').attr('disabled', 'true');
	$(form).find('textarea').attr('disabled', 'true');
	$(form).find('select').attr('disabled', 'true');
	
	lockModal(modal);
}
/**
 * end the loading status of the page, refer to function @submitWaiting
 *  
 * @param {Object} params
 */
function submitOver(params) {
	if(typeof params === 'undefined') params = {};
	var button = params.button ? params.button : '[data-action=submit]';
	var form = params.form ? params.form : document.body;
	var text = params.text ? params.text : '确 定';
	var html = params.html ? params.html : text;
	var modal = params.modal ? params.modal : 'modal-none';
	
	$(button).html(html);
	$(button).disabled(false);
	$(button).key('loading', '0');
	$(form).find('input').removeAttr('disabled');
	$(form).find('button').removeAttr('disabled');
	$(form).find('textarea').removeAttr('disabled');
	$(form).find('select').removeAttr('disabled');
	
	unlockModal(modal);
}

/**
 * before submit, clear the error message 
 */
function clearMessage() {
	$('.errorMessage').text('');
}


/**
 * if the verification failed, the error message must be shown
 * usually showing message after the component
 * 
 * @param {Object} error 
 */
function displayErrorMessage(error) {
	if(error.indexOf(TAG_ERROR_FLAG) < 0) return false;
	error = error.replace(TAG_ERROR_FLAG, '');
	error = JSON.parse(error);
	
	for(var key in error) {
		$('#' + key).text(error[key]);
	}
	
	return true;
}

/**
 * show debug message 
 * 
 * @param {String} msg 
 */
function debug(msg) {
	console.log(msg);
}

/**
 * headto
 *  
 * @param {String} url
 */
function go(url) {
	window.location = url;
}

/**
 * 
 * @param {Object} params
 */
function upload(params) {
	var input = params.input;
	var type = params.type;
	var callback = params.callback;
	var url = base_url + 'mng_upload/index';
	
  var formdata = new FormData();
  formdata.append('img', input.files[0]);
  formdata.append('type', type);

  var xhr = new XMLHttpRequest();
  xhr.open('post', url);
  xhr.send(formdata);
  
  xhr.onreadystatechange = function(s){
  	  if(xhr.readyState == 4 && xhr.status == 200) {
  	  	var data = xhr.responseText.toString();
  	  	callback(data);
  	  }
  };
}

function picturePreview(picture, files) {
	if(typeof FileReader == 'undefined') return;
	var fr = new FileReader();
	fr.onload = function(){
		$(picture).src(fr.result);
	}
	
	fr.readAsDataURL(files);
}

function sync(status) {
	if(typeof status === 'undefined') return inprogress();
	if(status) $(document.body).key('sync', 'true');
	else $(document.body).key('sync', 'false');
}

function inprogress() {
	if($(document.body).key('sync') == 'true') return true;
	else return false;
}
function indeal() {
	if($(document.body).key('sync') == 'true') return true;
	else return false;
}

function refresh() {
	var url = window.location.toString();
	if(url.indexOf('#') > -1) {
		window.location = url.replace('#', '');
	} else {
		window.location = url;
	}
}

function lockModal(modal) {
	$(modal).on('hide.bs.modal', function(event){
		event.preventDefault();
	});
}

function unlockModal(modal) {
	$(modal).unbind('hide.bs.modal');
}

function errorMsg(error) {
	if(error.indexOf(TAG_ERROR_FLAG) < 0) return false;
	var temp = error.replace(TAG_ERROR_FLAG, '');
	try {
		error = JSON.parse(temp);
	} catch(e) {
		error = temp;
	}
	if($('.home-error').length > 0) {
		var ul = $('.home-error ul');
	} else {
		var he = $('<div class="home-error"><ul></ul></div>');
		he.appendTo(document.body);
		ul = $('.home-error ul');
	}
	var errorMove = function(text){
			var li = $('<li class="error">' + text + '</li>');
			li.appendTo(ul);
			var width = li[0].offsetWidth;
			li.css('transform', 'translate3d(-' + width + 'px,0,0)');
			
			setTimeout(function(){
				li.css('transition', 'transform 300ms ease');
				li.css('transition', '-webkit-transform 300ms ease');
				li.css('transform', 'translate3d(0,0,0)');
			}, 100);
			setTimeout(function(){
				li.css('transform', 'translate3d(-' + width + 'px,0,0)');
				setTimeout(function(){
					li.remove();
				}, 300);
			}, 5000);
		};
	
	if(typeof error == 'string') {
		errorMove(error);
	} else {
		for(var key in error) {
			var text = error[key];
			errorMove(text);
		}
	}
	
	
	return true;
}

function msgBox(params) {
	var text = params.text;
	var type = params.type || 'info';
	
	if($('.home-error').length > 0) {
		var ul = $('.home-error ul');
	} else {
		var he = $('<div class="home-error"><ul></ul></div>');
		he.appendTo(document.body);
		ul = $('.home-error ul');
	}
	var errorMove = function(text){
			var li = $('<li class="' + type + '">' + text + '</li>');
			li.appendTo(ul);
			var width = li[0].offsetWidth;
			li.css('transform', 'translate3d(-' + width + 'px,0,0)');
			
			setTimeout(function(){
				li.css('transition', 'transform 300ms ease');
				li.css('transition', '-webkit-transform 300ms ease');
				li.css('transform', 'translate3d(0,0,0)');
			}, 100);
			setTimeout(function(){
				li.css('transform', 'translate3d(-' + width + 'px,0,0)');
				setTimeout(function(){
					li.remove();
				}, 300);
			}, 5000);
		};
	errorMove(text);
}

function request(params) {
	var url = params.url;
	var pArr = [];
	for(var key in params.params) {
		if(params.params[key] == '') continue;
		pArr.push(key + '=' + params.params[key]);
	}
	var paramStr = pArr.join('&');
	if(url.indexOf('?') > -1) {
		url += '&' + paramStr;
	} else {
		url += '?' + paramStr;
	}
	
	window.location = url;
}