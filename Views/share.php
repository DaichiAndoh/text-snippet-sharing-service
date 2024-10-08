<div style="width: 800px; margin: 0 auto;">
    <h5>snippet</h5>

    <div id="editor-container" style="width:800px;height:400px;border:1px solid grey"></div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.48.0/min/vs/loader.min.js" integrity="sha512-ZG31AN9z/CQD1YDDAK4RUAvogwbJHv6bHrumrnMLzdCrVu4HeAqrUX7Jsal/cbUwXGfaMUNmQU04tQ8XXl5Znw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.48.0/min/vs' }});
    require(['vs/editor/editor.main'], function() {
        monaco.editor.create(document.getElementById('editor-container'), {
            value: `<?= str_replace('`', '\`', $snippet['content']) ?>`,
            language: '<?= $snippet['language'] ?>',
            readOnly: true,
        });
    });
</script>
