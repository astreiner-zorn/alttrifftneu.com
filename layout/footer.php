</div>
</main>

<script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- CKEditor 5 CDN (UMD) -->
<link rel="stylesheet" href="/assets/ckeditor5/ckeditor5.css">
<script src="/assets/ckeditor5/ckeditor5.umd.js"></script>
<script src="/assets/ckeditor5/translations/de.umd.js"></script>

<!-- Highlight.js (optional, but enabled) -->
<link rel="stylesheet" href="/assets/highlight/styles/github-dark.min.css">
<script src="/assets/highlight/highlight.min.js"></script>
<script src="/assets/highlight/languages/php.min.js"></script>
<script src="/assets/highlight/languages/javascript.min.js"></script>
<script src="/assets/highlight/languages/css.min.js"></script>
<script src="/assets/highlight/languages/sql.min.js"></script>

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
    licenseKey: 'GPL',
    language: 'de',
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
