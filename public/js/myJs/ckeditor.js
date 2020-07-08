var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
    language:'vi',
    uiColor: '#14B8C4',
    };
CKEDITOR.replace('my-editor', options);


var route_prefix = "/laravel-filemanager?type=Images";
$('#lfm').filemanager('image', {prefix: route_prefix});
