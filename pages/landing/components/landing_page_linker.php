<div id="create">
    <form id="createForm" method="POST" action="/api/v1/links/create" enctype="application/x-www-form-urlencoded">
        <label class="create-link-text mdc-text-field mdc-text-field--filled">
            <span class="mdc-text-field__ripple"></span>
            <span class="mdc-floating-label" id="createLabel">Create a link</span>
            <input
				id="createForm_url"
				name="url"
                type="url"
                class="mdc-text-field__input"
                aria-labelledby="createLabel"
                placeholder="Place your URL here...">
            <span class="mdc-line-ripple"></span>
        </label>
        <div class="create-link-button">
            <button class="mdc-button mdc-button--raised">
                <span class="mdc-button__label">Create Link</span>
            </button>
        </div>
    </form>
</div>

<script>
    mdc.textField.MDCTextField.attachTo(document.querySelector('.mdc-text-field'));

    const form = document.querySelector("#createForm");
    form.addEventListener("submit", (event) => {
        // Immediately stop default actions.
        event.preventDefault();

        const url = document.querySelector("#createForm_url").value;

        // TODO check and post
	});
</script>