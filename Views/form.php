<div id="editor-container" style="width:800px;height:500px;border:1px solid grey"></div>

<div id="form" style="margin-top: 10px; display: none;">
    <select id="language-selector">
    </select>
    <select id="expiration-selector">
        <option value="10minutes">10 minutes</option>
        <option value="1hour">1 hour</option>
        <option value="1day">1 day</option>
    </select>
    <button id="create-url-btn">Craete URL</button>
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
            const language = document.getElementById('language-selector').value;
            const expiration = document.getElementById('expiration-selector').value;

            fetch('/create', {
                method: 'POST',
                body: JSON.stringify({
                    content: editor.getValue(),
                    language,
                    expiration,
                }),
            }).then(res => {
                return res.json();
            }).then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    window.open(`http://localhost:8000/share/${data.urlKey}`);
                }
            });
        });

        const formEl = document.getElementById('form');
        formEl.style.display = 'block';
    });
</script>
