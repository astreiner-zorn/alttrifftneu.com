</div>
</main>

<script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- CKEditor 5 CDN (UMD) -->
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/47.3.0/ckeditor5.css">
<script src="https://cdn.ckeditor.com/ckeditor5/47.3.0/ckeditor5.umd.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/47.3.0/translations/de.umd.js"></script>

<!-- Highlight.js (optional, but enabled) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/highlight.js@11.9.0/styles/github-dark.min.css">
<script src="https://cdn.jsdelivr.net/npm/highlight.js@11.9.0/highlight.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/highlight.js@11.9.0/languages/php.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/highlight.js@11.9.0/languages/javascript.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/highlight.js@11.9.0/languages/xml.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/highlight.js@11.9.0/languages/css.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/highlight.js@11.9.0/languages/sql.min.js"></script>

<script>
(function () {
  // 1) Highlight.js beim Anzeigen (z.B. auf index.php / detail.php)
  document.addEventListener('DOMContentLoaded', () => {
    if (!window.hljs) return;
    document.querySelectorAll('pre code').forEach(block => {
      hljs.highlightElement(block);
    });
  });

  // 2) CKEditor nur auf Seiten mit #editor initialisieren
  const el = document.querySelector('#editor');
  if (!el || !window.CKEDITOR) return;

  const {
    ClassicEditor,
    Essentials,
    Paragraph,
    Heading,
    Bold,
    Italic,
    Underline,
    Link,
    List,
    BlockQuote,
    CodeBlock,
    HorizontalLine,
    Table,
    TableToolbar,
    Font,
    SourceEditing,

    // Images
    Image,
    ImageToolbar,
    ImageCaption,
    ImageStyle,
    ImageResize,
    ImageInsert
  } = CKEDITOR;

  ClassicEditor.create(el, {
    licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3OTcyMDYzOTksImp0aSI6IjMwMjRjYTFlLTE4OWItNGRmYi1iYzE3LWQzM2I0MWQ2YjQ3MSIsImxpY2Vuc2VkSG9zdHMiOlsiKi5yaWZ0Y29yZS5kZSIsIioubG9jYWxob3N0Il0sInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCIsIkUyUCIsIkUyVyJdLCJ2YyI6ImQyMmI0YzBlIn0.v_V2Lw1DXb2l899ilpIxwb4eCZUCuKIhfMK3zgUHzp6AhGPqFqMtjEo1PPJU7I6EOcUsDiElc7AlhH3EmVgWaA',
    language: 'de',
    simpleUpload: {
      uploadUrl: '../assets/upload.php'
    },
    plugins: [
      Essentials,
      Paragraph,
      Heading,
      Bold,
      Italic,
      Underline,
      Link,
      List,
      BlockQuote,
      CodeBlock,
      HorizontalLine,
      Table,
      TableToolbar,
      Font,
      SourceEditing,

      Image,
      ImageToolbar,
      ImageCaption,
      ImageStyle,
      ImageResize,
      ImageInsert
    ],

    toolbar: [
      'sourceEditing', '|',
      'heading', '|',
      'bold', 'italic', 'underline', '|',
      'link', '|',
      'bulletedList', 'numberedList', '|',
      'codeBlock', 'blockQuote', 'horizontalLine', '|',
      'insertTable', '|',
      'imageInsert', '|',
      'fontSize', 'fontColor', 'fontBackgroundColor', '|',
      'undo', 'redo'
    ],

    // Bild-Toolbar: nur Items verwenden, die üblicherweise zuverlässig vorhanden sind
    image: {
      toolbar: [
        'imageTextAlternative',
        '|',
        'toggleImageCaption',
        '|',
        'imageResize:25',
        'imageResize:50',
        'imageResize:75',
        'imageResize:original'
      ]
    },

    // Tabellen-Toolbar
    table: {
      contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ]
    },

    // CodeBlock Sprachen (Highlight.js nimmt später "language-xxx" Klassen)
    codeBlock: {
      languages: [
        { language: 'plaintext', label: 'Text' },
        { language: 'php', label: 'PHP' },
        { language: 'javascript', label: 'JavaScript' },
        { language: 'html', label: 'HTML' },
        { language: 'css', label: 'CSS' },
        { language: 'sql', label: 'SQL' }
      ]
    }
  })
  .then(editor => {
    window.editor = editor;

    // 3) Beim Submit CKEditor-HTML in hidden field schreiben (add.php & edit.php)
    const form = document.getElementById('blogForm');
    const hidden = document.getElementById('content');
    if (form && hidden) {
      form.addEventListener('submit', function (e) {
        if (!window.editor) {
          e.preventDefault();
          alert('Editor ist nicht geladen.');
          return;
        }
        hidden.value = editor.getData();
      });
    }
  })
  .catch(err => {
    console.error('CKEditor init failed:', err);
  });
})();
</script>

</body>
</html>
