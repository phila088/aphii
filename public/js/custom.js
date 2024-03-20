(function(){
    document.addEventListener("DOMContentLoaded", function() {
        if (document.body.hasAttribute('data-notification')) {
            let types = ['success', 'info', 'warning', 'error']
            let type = '{{ Session::get('toast_type') }}'
            let message = "{{ Session::get('toast') }}"

            if (!types.includes(type)) {
                type = 'info'
            }

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "10000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            toastr[type](message)
        }
    });

    const searchBox = document.getElementById('typehead');

    hotkeys('alt+l,alt+m+p, alt+m+b, alt+a+b, alt+/', function (event, handler){
        switch (handler.key) {
            case 'alt+/':
                searchBox.click();
                searchBox.focus();
                break;
            case 'alt+l':
                document.getElementById('lock-app').click();
                break;
            case 'alt+m+p':
                window.location.href = "/dashboards/personal";
                break;
            case 'alt+m+b':
                window.location.href = "/brands";
                break;
            case 'alt+a+b':
                window.location.href = "/admin/brands";
                break;
            default: alert(event);
        }
    });
})();
