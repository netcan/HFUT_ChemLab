
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>elFinder 2.0</title>

    <!-- jQuery and jQuery UI (REQUIRED) -->
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <link href="http://cdn.bootcss.com/jqueryui/1.12.0/jquery-ui.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jqueryui/1.12.0/jquery-ui.min.js"></script>

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/elfinder.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/theme.css') ?>">

    <!-- elFinder JS (REQUIRED) -->
    <script src="<?= asset($dir.'/js/elfinder.min.js') ?>"></script>

    <!-- TinyMCE Popup class (REQUIRED) -->
    <script type="text/javascript" src="<?= asset($dir.'/js/tiny_mce_popup.js') ?>"></script>

    <?php if($locale){ ?>
        <!-- elFinder translation (OPTIONAL) -->
        <script src="<?= asset($dir."/js/i18n/elfinder.$locale.js") ?>"></script>
    <?php } ?>


    <script type="text/javascript">
        var FileBrowserDialogue = {
            init: function() {
                // Here goes your code for setting your custom things onLoad.
            },
            mySubmit: function (URL) {
                var win = tinyMCEPopup.getWindowArg('window');

                // pass selected file path to TinyMCE
                win.document.getElementById(tinyMCEPopup.getWindowArg('input')).value = URL;

                // are we an image browser?
                if (typeof(win.ImageDialog) != 'undefined') {
                    // update image dimensions
                    if (win.ImageDialog.getImageData) {
                        win.ImageDialog.getImageData();
                    }
                    // update preview if necessary
                    if (win.ImageDialog.showPreviewImage) {
                        win.ImageDialog.showPreviewImage(URL);
                    }
                }

                // close popup window
                tinyMCEPopup.close();
            }
        }

        tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);

        $().ready(function() {
            var elf = $('#elfinder').elfinder({
                // set your elFinder options here
                <?php if($locale){ ?>
                    lang: '<?= $locale ?>', // locale
                <?php } ?>
                customData: { 
                    _token: '<?= csrf_token() ?>'
                },
                url : '<?= route("elfinder.connector") ?>',  // connector URL
                getFileCallback: function(file) { // editor callback
                    FileBrowserDialogue.mySubmit(file.url); // pass selected file path to TinyMCE
                }
            }).elfinder('instance');
        });
    </script>

</head>
<body>

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>

</body>
</html>
