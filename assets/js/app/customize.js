//=================================== Cookies ==================================================//
let setCookie = (cookie, value) => {
  let setCookie;
  let authacno = $('meta[name="auth-acno"]').attr('content');
  if (authacno != '') {
    setCookie = $.cookie(`${cookie}-${authacno}`, value);
  }
  return setCookie;
};
let getCookie = (cookie) => {
  let getCookie;
  let authacno = $('meta[name="auth-acno"]').attr('content');
  if (authacno != '') {
    getCookie = $.cookie(`${cookie}-${authacno}`);
  }
  return getCookie;
};
let removeCookie = (cookie) => {
  let removeCookie;
  let authacno = $('meta[name="auth-acno"]').attr('content');
  if (authacno != '') {
    removeCookie = $.removeCookie(`${cookie}-${authacno}`);
  }
  return removeCookie;
};
//=================================== Cookies ==================================================//

//=================================== Active Menu ==================================================//
$("ul.m-menu__nav > li.m-menu__item a").click(function (e) {
  var link = $(this);
  var item = link.parent("li.m-menu__item");
  if (item.children("ul").length > 0) {
    var href = link.attr("href");
    link.attr("href", "#");
    setTimeout(function () {
      link.attr("href", href);
    }, 300);
    e.preventDefault();
  }
}).each(function () {
  var link = $(this);
  if (getCookie('sidebarCollapsed') == 'Yes') {
    $("body").addClass("sidebar-collapsed");
  } else {
    $("body").removeClass("sidebar-collapsed");
  }
  if (location.href == "/dashboard") {
    $(".hamburger--elastic.toggle-sidebar").removeClass("is-active");
    link.parent("li.m-menu__item").addClass("mm-active").parents("li.m-menu__item.m-menu__item--submenu").children("ul").addClass("mm-show");
    return false;
  }
  if (link.get(0).href === location.href) {
    link.parent("li.m-menu__item").addClass("mm-active").parents("li.m-menu__item.m-menu__item--submenu").children("ul").addClass("mm-show");
    $(".hamburger--elastic.toggle-sidebar").addClass("is-active");
    return false;
  }
});
$(document).on('click', '.toggle-sidebar', function () {
  let sidebarCollapsed = ($('body').hasClass('sidebar-collapsed')) ? 'Yes' : 'No';
  setCookie('sidebarCollapsed', sidebarCollapsed);
  if (location.pathname != '/dashboard') {
    if ($('.table').length) {
      setTimeout(() => {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw().responsive.recalc();
        console.log(`Adjust DataTable`);
      }, 2000);
    }
  }
});
//=================================== Active Menu ==================================================//
//=================================== Validation ==================================================//
// Textarea Validation
$('textarea, input[type=text]').on('keypress', function (event) {
  if (event.charCode != 13) {
    var regex = new RegExp("^[a-zA-Z0-9- ,_.?+]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
      return false;
    }
  }
});
// Email Validation
$('input[type=email]').on('keypress', function (event) {
  var regex = new RegExp("^[a-zA-Z0-9@_.-]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});
$('textarea, input').on('drop', function (e) {
  e.preventDefault();
});
// For Only Digits
$(document).on('keypress', '.digits', function () {
  var regex = new RegExp("^[0-9.+]+$");
  var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
    return false;
  }
});
// Only Alphabets
$(function () {
  $(".alphabets").keydown(function (e) {
    if (e.altKey) {
      e.preventDefault();
    } else {
      var key = e.keyCode;
      if (!(key == 8 || key == 9 || key == 32 || key == 46 || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
        e.preventDefault();
      }
    }
  });
});
//=================================== Validation ==================================================//
//=================================== FileName ==================================================//
$(document).on('change', '.uploadFile', function () {
  let file = $('.uploadFile')[0].files[0].name;
  $("#outputFile").text(file);
});
//=================================== FileName ==================================================//
//=================== Check All ===================
$(document).on('click', "#checkAll", function () {
  $(".m-checkable").prop("checked", this.checked);
  checkall();
});
let checkall = () => {
  var checkedCount = $('.m-checkable:checked').length;
  if (checkedCount > 0) {
    $('#applyall').addClass('d-block').slideDown();
    $('#applyall').removeClass('d-none').slideDown();
  } else {
    $('#applyall').addClass('d-none').slideUp();
    $('#applyall').removeClass('d-block').slideUp();
  }
};
//=================== Check All ===================
//=================================== INIT Tooltip ==================================================//
let init_tooltip = () => {
  $('[data-toggle="tooltip"]').tooltip();
};

//=================================== INIT Tooltip ==================================================//

//=================================== INIT Popover ==================================================//
let init_popover = (props) => {
  if (props == 'popover') {
    $('[data-toggle="popover"]').popover();
  } else if (props == 'custom_popover') {
    $('.popover-custom').each((function () {
      $(this).popover({
        html: true,
        content: function () {
          return $('#' + $(this).data('tip')).html();
        }
      });
    }));
  }
};
//=================================== INIT Popover ==================================================//
//=================================== Number Format ==================================================//
let formatNumberCommas = (number) => {
  var parts = number.toString().split(".");
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  return parts.join(".");
}
//=================================== Number Format ==================================================//
//=================================== INIT & Destroy LOADER ==================================================//
let initLoader = (id, text, className) => {
  $(`#${id}`).html('');
  $(`#${id}`).removeClass(className);
  $(`#${id}`).css('min-width', '150px');
  $(`#${id}`).css('text-align', 'center');
  $(`#${id}`).html(`<div class="spinner-border m-2 text-primary" role="status" id="initLoader">
    <span class="sr-only">Loading...</span>
  </div>`);
};
let destroyLoader = (id, text, className) => {
  $(`#${id}`).html('');
  $(`#${id}`).addClass(className);
  $(`#${id}`).removeAttr("style");
  setTimeout(() => {
    $(`#${id}`).html(text);
  }, 100);
};
//=================================== INIT & Destroy LOADER ==================================================//
//=================================== Open With Post ==================================================//
let OpenWindowWithPost = (url, name, params) => {
  var form = document.createElement("form");
  form.setAttribute("method", "post");
  form.setAttribute("action", url);
  form.setAttribute("target", name);
  for (var i in params) {
    if (params.hasOwnProperty(i)) {
      var input = document.createElement('input');
      input.type = 'hidden';
      input.name = i;
      input.value = params[i];
      form.appendChild(input);
    }
  }
  document.body.appendChild(form);
  if (name == '_blank') { } else {
    window.open("post.htm", name);
  }
  form.submit();
  document.body.removeChild(form);
};
//=================================== Open With Post ==================================================//
//=================================== Select2 Function ==================================================//
let init_select2 = () => {
  $((function () {
    $('[data-toggle="custom-select2"]').each((function () {
      $(this).select2({
        theme: 'bootstrap4',
        width: 'element',
        placeholder: $(this).attr('placeholder'),
        allowClear: Boolean($(this).data('allow-clear'))
      });
    }));
  }));
};
//=================================== Select2 Function ==================================================//

//=================================== Input Mask ==================================================//
let inputMask = () => {
  $((function () {
    $('[data-input="time"]').mask('00:00');
  }));
}
//=================================== Input Mask ==================================================//

//=================================== Notify Function ==================================================//
let Notification = (type, title, message) => {
  let icon;
  (type == 'danger') ? icon = 'exclamation-circle' : (type == 'warning') ? icon = 'exclamation-triangle' : icon = 'check-circle';
  $.notify({
    // options
    icon: 'glyphicon glyphicon-warning-sign',
    title: title,
    message: message,
    target: '_blank',
    url: '#example'
  }, {
    // settings
    type: type,
    newest_on_top: true,
    allow_dismiss: true,
    showProgressbar: true,
    animate: {
      enter: 'animated zoomIn',
      exit: 'animated zoomOut'
    },
    placement: {
      from: "top",
      align: "center"
    },
    offset: {
      x: 15,
      y: 15
    },
    spacing: 10,
    z_index: 1080,
    delay: 1500,
    timer: 2500,
    url_target: "_blank",
    mouse_over: !1,
    template: '<div data-notify="container" class="alert alert-dismissible text-white-50 shadow-sm alert-notify" role="alert">\n' +
      '    <div class="alert-wrapper-bg bg-{0}"></div>\n' +
      '    <div class="alert-content-wrapper">\n' +
      '        <i class="fas fa-' + icon + '"></i>\n' +
      '        <div class="pl-3">\n' +
      '            <span class="alert-title text-white" data-notify="title">{1}</span>\n' +
      '            <div data-notify="message" class="alert-text">{2}</div>\n' +
      '        </div>\n' +
      '    </div>\n' +
      '<button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">×</span></button>\n' +
      '</div>'
  });
};
//=================================== Notify Function ==================================================//
// =================================== Init Counter ================================================= 
let initCounter = () => {
  $('[data-count="number"]').each(function () {
    var $this = $(this);
    var originalNumber = $this.text();
    $this.prop('Counter', 0).animate({
      Counter: parseInt(originalNumber.replace(/[,]/g, ''))
    }, {
      delay: 10,
      duration: 1000,
      easing: 'swing',
      step: function (now) {
        $this.text(Math.ceil(now).toLocaleString());
      },
      complete: function () {
        $this.text(originalNumber);
      }
    });
    $('[data-count="number"]').addClass('animated fadeInDownBig');
  });
}
// =================================== Init Counter ================================================= 
//=================================== Set Column Visibility Menu ==================================================//
$(document).on('click', '.buttons-collection.dropdown-toggle.buttons-colvis', function () {
  let table = $(this).parents('.dataTables_wrapper').find('table')
  let columnCount = table.DataTable().columns().count() - 1;
  let menu = $('.btn-group').find(".dt-button-collection.dropdown-menu.fixed.two-column");
  if (columnCount == 3 || columnCount == 6) {
    menu.removeClass('two-column');
    menu.addClass('three-column');
  } else if (columnCount == 4 || (columnCount > 6 && columnCount < 9) || (columnCount > 10 && columnCount < 13) || columnCount == 16) {
    menu.removeClass('two-column');
    menu.addClass('four-column');
  }
});
//=================================== Set Column Visibility Menu ==================================================//

//=================================== Toggle Password ==================================================//
let togglePassword = (eyebtn) => {
  var password = $(eyebtn).closest('span').prevAll('input:first');
  var type = password[0].getAttribute("type") === "password" ? "text" : "password";
  password[0].setAttribute("type", type);
  eyebtn.classList.toggle("bi-eye");
}
//=================================== Toggle Password ==================================================//
//=================================== Init Date Picker ==================================================//
const init_datepicker = () => {
  var e = $('[data-toggle="datepicker"]');
  e.length && e.each((function () {
    $(this).datepicker({ disableTouchKeyboard: !0, autoclose: !1 })
  }))
}
//=================================== Init Date Picker ==================================================//



//=================================== Init Datatable ==================================================//
let initDatatable = (id, type) => {
  switch (type) {
    case 'single':
      $(`#${id}`).DataTable().ajax.reload();
      break;

    case 'multiple':
      id.map((selector) => {
        $(`#${selector}`).DataTable().ajax.reload();
      });
      break;
  }
};
//=================================== Init Datatable ==================================================//

//=================================== Obect Check ==================================================//
function isObject(variable) {
  return typeof variable === 'object' && variable !== null && !Array.isArray(variable);
}
//=================================== Obect Check ==================================================//
//==================================== PARSELEY CUSTOM VALIDATION =============================================
window.Parsley.addValidator('cnic', {
  validateString: function (value) {
    var cnicRegex = /^([1-8])(?:(?:(?!\1)[0-9]){3}|(?!([0-9])\2{2}))[0-9]{4}-[0-9]{7}-[0-9]$/;
    if (!cnicRegex.test(value)) {
      return false;
    }
    return true;
  },
  messages: {
    en: 'Invalid CNIC number',
  },
});
window.Parsley.on('field:error', function() {
  this.$element.addClass('is-invalid').removeClass('is-valid');

  var label = this.$element.parent('div').find('label').clone().find('span').remove().end().text().trim();
  var errorMessage = this.$element.parent('div').find('.parsley-required').text();
  var finalMessage = errorMessage.replace('This value', label);
  this.$element.parent('div').find('.parsley-required').text(finalMessage);

  if(this.$element.hasClass('select2-hidden-accessible')){
    var div = this.$element.parent();
    div.append(this.$element.parent().find('.parsley-errors-list'));
  }
});

$('form [data-toggle="custom-select2"]').on('change', function() {
  $(this).parsley().validate();
});

window.Parsley.on('field:success', function() {
  this.$element.removeClass('is-invalid').addClass('is-valid');
});
//==================================== PARSELEY CUSTOM VALIDATION =============================================

//==================================== Datatable Search Filter =============================================
let init_search = () => {
  $(".dataTables_filter").addClass("pr-0");
  $(".dataTables_filter input[type='search']").removeClass("form-control-sm");
  $(".dataTables_filter input[type='search']").addClass("dt-search");
  $(".buttons-excel").attr({
    "data-toggle": "tooltip",
    "data-original-title": "Export Excel",
  });
  $(".buttons-colvis").attr({
    "data-toggle": "tooltip",
    "data-original-title": "Column Visibility",
  });
  $(".buttons-csv").attr({
    "data-toggle": "tooltip",
    "data-original-title": "Export CSV",
  });
};
//==================================== Datatable Search Filter =============================================

//=================== INIT COLVIS ===================
$('table .dataTable').on('column-visibility.dt', function(e, settings, column, state) {
  if (state) {
     init_tooltip();
  }
});
//=================== INIT COLVIS ===================


// =================================== Init CKEditor ===========================================
let initCKEditor = () => {
  document.querySelectorAll('[data-ckeditor]').forEach((element) => {
    CKEDITOR.replace(element, {
      on: {
        paste: function (event) {
          event.data.dataValue = event.data.dataValue.replace(/<\/?[^>]+(>|$)/g, "");
        }
      }
    });
  });
};
// =================================== Init CKEditor ============================================