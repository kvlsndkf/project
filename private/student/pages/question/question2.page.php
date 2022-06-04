<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body>
    <!-- Create the editor container -->
    <div id="editor"></div>
    <textarea name="" id="textArea"></textarea>

    <div id="bt"></div>
    <button>Perguntar</button>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        var support = (function() {
            if (!window.DOMParser) return false;
            var parser = new DOMParser();
            try {
                parser.parseFromString('x', 'text/html');
            } catch (err) {
                return false;
            }
            return true;
        })();

        function stringToHTML(str) {

            // If DOMParser is supported, use it
            if (support) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(str, 'text/html');
                return doc.body;
            }

            // Otherwise, fallback to old-school method
            var dom = document.createElement('div');
            dom.innerHTML = str;
            return dom;

        };

        var options = [
            [{
                'header': '1'
            }, {
                'header': '2'
            }],
            ['bold', 'italic', 'strike', 'underline', 'blockquote'],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }, {
                'align': []
            }, {
                'direction': 'rtl'
            }],
            ['code', 'code-block', {
                'script': 'super'
            }, {
                'script': 'sub'
            }],
            ['link', 'image', 'video']
        ]

        var editor = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Compose an epic...',
            modules: {
                toolbar: options
            }
        });


        editor.on('text-change', function() {
            var abc = editor.root.innerHTML;
            const text = document.getElementById('textArea');

            text.innerText = abc;

            const bt = document.getElementById('bt');
            // bt.innerHTML = stringToHTML(text.innerHTML);
            bt.append(stringToHTML(text.value));

        });
    </script>
</body>

</html>