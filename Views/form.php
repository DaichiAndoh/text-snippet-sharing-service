<div id="editor-container" style="width:800px;height:500px;border:1px solid grey"></div>

<div id="select-btn-wrapper" style="margin-top: 10px; display: none;">
    <select id="language-selector">
    </select>
    <button id="create-url-btn">Create URL</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.48.0/min/vs/loader.min.js" integrity="sha512-ZG31AN9z/CQD1YDDAK4RUAvogwbJHv6bHrumrnMLzdCrVu4HeAqrUX7Jsal/cbUwXGfaMUNmQU04tQ8XXl5Znw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    require.config({ paths: { 'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.48.0/min/vs' }});
    require(['vs/editor/editor.main'], function() {
        const editor = monaco.editor.create(document.getElementById('editor-container'), {
            value: '',
            language: 'plaintext',
        });

        const selectEl = document.getElementById('language-selector');
        const languages = monaco.languages.getLanguages();
        for (const lang of languages) {
            const optionEl = document.createElement('option');
            optionEl.value = lang.id;
            optionEl.innerText = lang.id;
            selectEl.appendChild(optionEl);
        }
        selectEl.addEventListener('change', event => {
            monaco.editor.setModelLanguage(editor.getModel(), event.target.value);
        });

        const btnEl = document.getElementById('create-url-btn');
        btnEl.addEventListener('click', _ => {
            console.log('clicked!');
        });

        const wrapperEl = document.getElementById('select-btn-wrapper');
        wrapperEl.style.display = 'block';
    });
</script>
