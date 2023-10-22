/*form start*/


paceOptions = { //this objects are for pace.js, it is for displaying progressbar on ajax requests
    ajax: {
        trackMethods: ['GET', 'POST', 'DELETE', 'PUT', 'PATCH'],

    }
};

function loadPageWithToken() {
    $.ajax({
        url: '../ajax/newSession.php',
        success: function (r) {
            loadPage(r);
        }
    });
}


function alert(message, icon = 'success') {
    swal({
        text: message,
        icon: icon,
        confirmButtonText: 'Ok'
    });
}

function errorAlert(message, icon = 'success', title = '') {
    if (!Array.isArray(message)) {
        swal({
            title: title,
            text: message,
            icon: 'error',
            confirmButtonText: 'Ok'
        });
    } else if (message.length > 0) {
        var s = document.createElement('div');
        var err = `The following errors were detected: <ul>`;
        $.each(message, function (k, v) {
            err += `<li>${v}</li>`;
        });
        s.style.textAlign = 'justify';
        s.innerHTML = err;
        swal({
            content: s,
            icon: 'error',
        });
    }
}

function alert2(message, icon = 'success', title = '') {
    swal({
        title: title,
        text: message,
        icon: icon,
        confirmButtonText: 'Ok'
    })
}


function question(message, callback, title = '') {
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        buttons: true,
    }).then((result) => {

        ///console.log(result.value);
        if (result) {
            callback();
        }
    })
}

function question2(message, callback, title = '') {
    swal({
        title: 'Are you sure?',
        text: message,
        icon: 'warning',
        buttons: true,
    }).then((result) => {

        ///console.log(result.value);
        if (result) {
            callback();
        }
    })
}


function goTo(url) {
    var base = location.hash.split('/')[0].replace('#', '');
    location.hash = base + '/' + url;
}

function lastPage() {
    return location.hash.split('/')[1].split('?')[0];
}

function setEmpty(form) {
    //This function clear form fields given a form
    form = form.serialize(); //this method converts all form fields to filed1=value1&field2=value2
    elems = form.split('&');

    for (var i in elems) {
        e = elems[i].split('=');
        //if(  $('input[type!=radio]') ) {
        if (e[0] !== "csrf_token") //do not clrear csrf_token field
            $('input[name="' + e[0] + '"][type!="radio"]').val("");
        $('select[name="' + e[0] + '"]').val('').change();
        //}
    }
}


var form = $(document).find('#form');
form.submit(function (e) {

    e.preventDefault(); //disable auto submit

});
var form = $(document).find('#form');
form.submit(function (e) {

    e.preventDefault(); //disable auto submit

});


function showTabs(tabs) {
    var tabs = tabs.split(',');
    var h = "";
    var loc = location.href.split('/');
    var p = loc[5].replace('#', '');

    for (var i in tabs) {
        var r = tabs[i].split(' ');
        var url = r[0].toLocaleLowerCase() + r[1];
        h += "<li class='nav-item'><a href='#" + p + '/' + url + "' class='nav-link'>" + tabs[i] + "</a></li>";

    }


    var m = tabs[0].split(' ');
    var mUrl = m[0].toLocaleLowerCase() + m[1];
    //$('#myTabs').html(h);
    //var last = location.hash.split('/')[1];

    $('#myTabs').html(h);
    $('#myTabs li a').each(function (i) {
        var last = location.hash.split('/')[1];
        $(this).removeClass('active');
        var href = $(this).attr('href').split('/')[1];
        //alert(last);
        if (last.split('?')[0] == href) {
            $(this).addClass('active');
        }
    });
    //alert(p+'/'+mUrl);
    location.hash = p + '/' + mUrl;


    /* $('#myTabs li a').each(function (i) {
         $(this).removeClass('active');
         var href = $(this).attr('href').split('/')[1];
         //alert(last);
         if(last.split('?')[0] == href) {
             $(this).addClass('active');
         }
     });*/


}

function capitalizEachWord(text) {
    var texts = text.split(' ');

}


function setTitle() {

}

function hideModal(selector) {
    $(selector).modal('hide');
    $('.modal-backdrop').hide();
    $('body.modal-open').css('overflow-y', 'scroll');
    $('body').css('padding-right', '0');
}


function loadPage(_token) {

    var params = getParams();
    params['csrf_token'] = _token;


    var loc = location.href.split('/');
    loc = new Proxy(loc, {});
    var url = loc[loc.length - 2] + '/' + loc[loc.length - 1];
    var module = loc[loc.length - 2] + '/' + loc[loc.length - 1].split('?')[0];

    url = '../modules/' + module.replace('#', '') + '.php';
    if (loc[loc.length - 2] === 'applicant')
        url = loc[loc.length - 1].replace("#", "") + '.php';

    Pace.restart();
    $('.page-body').html("");

    if (loc.indexOf("#dashboard") > -1)
        url = "dashboard.php";

    if (loc.indexOf("#dashboard") > -1)
        url = "dashboard.php";
        
    var user = loc[loc.length - 3];
    var testUrls = ['guest', 'applicant', 'student'];

    $.ajax(url, {
        method: "GET",
        data: params,
        success: function (data) {
            
            
            if (url != 'dashboard.php' && !testUrls.includes(user)) {
                var x = " <div class=\"row d-block\" >\n" +
                    "            <div class=\"col-sm-12 d-block\">\n" +
                    "                <div class=\"card d-block\">\n" +
                    "                    <div class=\"card-header no-print\">\n" +
                    "                        <h5 class=\"card-title\">Dashboard </h5>\n" +
                    "                        <div class=\"card-header-right\">\n" +
                    "                            <div class=\"btn-group card-option\">\n" +
                    "                                <button class=\"btn\">\n" +
                    "                                    <span class=\"title\"></span>\n" +
                    "                                    <span class=\"sub-title\"></span>\n" +
                    "                                </button>\n" +
                    "                                <button type=\"button\" class=\"btn dropdown-toggle btn-icon\" data-toggle=\"dropdown\"\n" +
                    "                                        aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
                    "                                    <i class=\"feather icon-more-horizontal\"></i>\n" +
                    "                                </button>\n" +
                    "                                <ul class=\"list-unstyled card-option dropdown-menu dropdown-menu-right\">\n" +
                    "                                    <li class=\"dropdown-item full-card\"><a><span><i class=\"feather icon-maximize\"></i> maximize</span><span\n" +
                    "                                                    style=\"display:none\"><i\n" +
                    "                                                        class=\"feather icon-minimize\"></i> Restore</span></a></li>\n" +
                    "                                </ul>\n" +
                    "                            </div>\n" +
                    "                        </div>\n" +
                    "                    </div>\n" +
                    "                    <div id=\"page\" class=\"card-body d-block\">\n" +
                    "\n" + data +
                    "                    </div>\n" +
                    "\n" +
                    "                </div>\n" +
                    "            </div>\n" +
                    "\n" +
                    "        </div>\n"
                
            } else {
                x = data;
            }
           

            $('#page-m').html(x);





            $(".pcoded-inner-navbar li").removeClass('active');
            $(".pcoded-inner-navbar li").removeClass('pcoded-trigger');


            var item = $(".pcoded-inner-navbar").find("[href='" + module + "']");

            item.parent().addClass('active');


            item.parents().eq(2).addClass('active');

            if ($('#myNav').hasClass('menupos-fixed'))
                item.parents().eq(2).addClass('pcoded-trigger');


            var level = 0;
            if (item.parents().eq(3).hasClass('pcoded-inner-navbar'))
                level = 2;
            else
                level = 3;

            var title = item.parents().eq(level).find('span:eq(1)').html();


            if (item.html() != undefined) {
                $('.page-header-title h5').html(item.html().toUpperCase());
                $('.card-title').html(item.html().toUpperCase());
                //console.log(item.parents().eq(3).html());


                if (level == 2) {
                    $('.breadcrumb li:first-child').html(item.parents().eq(level).find('span:first').html() + " " +
                        item.parents().eq(level).find('span:nth-child(2)').html());
                    $('.breadcrumb li:nth-child(2)').hide();
                } else if (level == 3) {
                    item.parents().eq(4).addClass('active');
                    item.parents().eq(4).addClass('pcoded-trigger');
                    $('.breadcrumb li:first-child').html(item.parents().eq(4).find('a:first').html());
                    $('.breadcrumb li:nth-child(2)').html(item.parents().eq(3).find('a:first').html());
                }


                //$('.breadcrumb li:nth-child(2)').html(item.parents().eq(level).find('span:first').html());

                $('.breadcrumb-title li:nth-child(2)').html(title);

            }

            $(document).find('#form').submit(function (e) {
                e.preventDefault();
            });

            $(document).find('#searchForm').submit(function (e) {
                e.preventDefault();
            });


            $(document).find('#tabs').find('a').removeClass('active');
            var tab = $(document).find('#tabs').find('[href="' + window.location.hash + '"]');
            tab.addClass('active');


            var nextLink = tab.parent().next();
            nextLink = nextLink.find('a').attr('href');

            var prev = $(document).find('.btn-page').find('.button-previous');
            var next = $(document).find('.btn-page').find('.button-next');
            if ($(document).find('#tabs li:first a').attr('href') == window.location.hash) {
                prev.addClass('disabled');
            } else {
                prev.removeClass('disabled');
            }

            if ($(document).find('#tabs li:last a').attr('href') == window.location.hash) {
                next.addClass('disabled');
            } else {
                next.removeClass('disabled');
            }
            prev.click(function (e) {

                if (!prev.hasClass('disabled')) {
                    var prevLink = tab.parent().prev();

                    prevLink = prevLink.find('a').attr('href');
                    if (prevLink != undefined)
                        window.location.href = prevLink;
                }
            });


            next.click(function (e) {
                var me = $(this);


                if ($(document).find('form').length === 0)
                    if (!next.hasClass('disabled'))
                        window.location.href = nextLink
                var c = window.location.hash.replace('#', '');
                c = c.split('/')[1];
                
                var form = $(document).find('#page-m').find('form[id!="alevelForm"]');
               
                
                form.parsley().validate();


                if (form.parsley().isValid()) {
                    if (me.data('requestRunning')) {
                        console.log('stop')
                        return;
                    }
                    me.data('requestRunning', true);
                    var data = form.serialize();
                    $.ajax({
                        url: '../ajax/user.php?action=' + c,
                        type: 'POST',
                        data: data,
                        dataType: 'json',
                        success: function (res) {
                            if (res.status != 200) {
                                errorAlert(res.message);
                            } else {
                                if (!next.hasClass('disabled') && nextLink !== undefined) {
                                    window.location.href = '#student/' + res.next;
                                }
                                //;
                            }
                        },
                        complete: function () {
                            me.data('requestRunning', false);
                        }
                    })
                }
            });

            function showPercent() {
                var $total = $('#tabs').find('li').length;
                var $current = $('#tabs').find('a[href="' + window.location.hash + '"]').parent().index() + 1;
                var $percent = ($current / $total) * 100;
                $('.progress-bar').css({
                    width: $percent + '%'
                });
            }

            showPercent();


            var page_name = $(document).find('[name=fug-page-name]');
            if (page_name.val() != undefined)
                $('.card-title').html(page_name.val().toUpperCase());

            $(document).find('select').css('width', '100%');
            try {
                $(document).find('select').select2();
            } catch (y) {
            }

            let paginationDiv = $('#pagination');
            if (paginationDiv.length == 1) {
                $('#records2 a[id!=n]').css('color', '#2e6da4');
                $('#records2 a[id!=n]').css('cursor', 'pointer');
                let total = paginationDiv.attr('total');
                let perpage = paginationDiv.attr('perpage');
                let page = paginationDiv.attr('page');
                let sort = paginationDiv.attr('sort');
                //$('select').css('line-height', '30px');
                //


                //$(document).find('select').select2();
                pagination(total, perpage, page);
            }
        },
        error: function (code) {
            alert("Invalid Page", 'error');
        }
    });
}


function pdf_print(div) {
    var text = $('#' + div).clone();
    text.find('button').remove();
    text.find('textarea:empty').remove();
    text = text.find('form').html();


    //var contents = '<link type="text/css" rel="stylesheet" href="../assets/css/style.css" />';

    var contents = "<html><head><style> .row{display:flex;flex-wrap:wrap;margin-right:-15px;margin-left:-15px} .col-sm-2{flex:0 0 16.66667%;max-width:16.66667%} .col-sm-8{flex:0 0 66.66667%;max-width:66.66667%} </style></head><body>";

    //text = text.replace("<textarea style='border:none;text-align:right' rows='2' cols='30' name='remark[]'>", "");
    //text = text.replace("</textarea>", "");
    contents += text + "</body></html>";


    $.ajax({
        url: '../ajax/user.php?action=printPdF',
        type: 'POST',
        data: {html: contents},
        xhrFields: {
            responseType: 'blob'
        },
        success: function (data) {
            var a = document.createElement('a');
            var url = window.URL.createObjectURL(data);
            a.href = url;
            a.download = 'myfile.pdf';
            document.body.append(a);
            a.click();
            a.remove();
            window.URL.revokeObjectURL(url);
        }
    });
}

$(document).on('change', '[name=programTypeId]', function (e) {
    $(document).find('select[name=programId]').html("<option></option>");
    var data = {
        id: $(this).val(),
        csrf_token: $(document).find('input[name=csrf_token]').val()
    };

    if ($(document).find('select[name=departmentId]').length > 0)
        data['departmentId'] = $(document).find('select[name=departmentId]').val();

    $.ajax({
        url: '../ajax/program.php?action=viewProgramByType',
        type: 'GET',
        data: data,
        dataType: 'json',
        success: function (response) {
            if (response.status === 100) {
                alert(res.message, 'error');
                return;
            }
            for (var i in response) {
                $(document).find('select[name=programId]').append(new Option(response[i].name, response[i].programId));
            }

        }
    });
});


$(document).on('change', '[name=facultyId]', function (e) {
    $('select[name=departmentId]').html("<option></option>");
    $.ajax({
        url: '../ajax/program.php?action=viewDepartment',
        type: 'GET',
        data: {
            id: $(this).val(),
            csrf_token: $(document).find('input[name=csrf_token]').val()
        },
        dataType: 'json',
        success: function (response) {
            if (response.status === 100) {
                alert(res.message, 'error');
                return;
            }
            for (var i in response) {
                $('select[name=departmentId]').append(new Option(response[i].name, response[i].departmentId));
            }

            if ($('input[name=ajaxDepartmentId]').val() != "") {
                $('select[name=departmentId]').val($('input[name=ajaxDepartmentId]').val()).change();
            }
        }
    });
});

$(document).on('change', '[name=departmentId]', function (e) {
    Pace.restart();
    $('select[name=programId]').html("<option></option>");
    $.ajax({
        url: '../ajax/program.php?action=viewProgram',
        type: 'GET',
        data: {
            departmentId: $(this).val(),
            csrf_token: $(document).find('input[name=csrf_token]').val()
        },
        dataType: 'json',
        success: function (response) {
            if (response.status === 100) {
                alert(res.message, 'error');
                return;
            }
            for (var i in response) {
                $('select[name=programId]').append(new Option(response[i].name, response[i].programId));
            }

            if ($('input[name=ajaxProgramId]').val() != "") {
                $('select[name=programId]').val($('input[name=ajaxProgramId]').val()).change();
            }

        }
    });
});


$(document).on('change', '[name=hostelId]', function (e) {
    Pace.restart();
    $('select[name=blockId]').html("<option></option>");
    $.ajax({
        url: '../ajax/student.php?action=viewAllBlock',
        type: 'POST',
        data: {
            id: $(this).val(),
            csrf_token: $('input[name=csrf_token]').val(),
        },
        dataType: 'json',
        success: function (response) {
            for (var i in response) {
                $('select[name=blockId]').append(new Option(response[i].name, response[i].blockId));
            }
            if ($('input[name=ajaxBlockId]').val() != "") {
                $('select[name=block]').val($('input[name=ajaxBlockId]').val()).change();
            }
        }
    });
});


function loadPageOnly() {
    var l = window.location.href.split('?')[0]
    window.location.href = l;
    loadPage();
}

$(document).find('.save').click(function (e) {
    var me = $(this);
    var form = $(document).find('#page').find('form[id!="alevelForm"]');
    form.parsley().validate();
    if (form.parsley().isValid()) {
        if (me.data('requestRunning')) {
            console.log('stop')
            return;
        }
        var c = window.location.hash.replace('#', '');
        c = c.split('/')[1];
        me.data('requestRunning', true);
        var data = form.serialize();
        $.ajax({
            url: '../ajax/user.php?action=' + c,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function (res) {
                if (res.status != 200) {
                    errorAlert(res.message);
                } else {
                    if (!next.hasClass('disabled') && nextLink !== undefined)
                        window.location.href = '#student/' + res.next;
                    //;
                }
            },
            complete: function () {
                me.data('requestRunning', false);
            }
        })
    }
});

function saveAs(uri, filename) {

    var link = document.createElement('a');

    if (typeof link.download === 'string') {

        link.href = uri;
        link.download = filename;

        //Firefox requires the link to be in the body
        document.body.appendChild(link);

        //simulate click
        link.click();

        //remove the link when done
        document.body.removeChild(link);

    } else {

        window.open(uri);

    }
}


function pdfPrint(selector) {


}

