<?php

use App\Models\PotentialClient;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

new class extends Component {
    public array $interviewMethodTypes = [];

    #[Validate('required|string|min:2|max:50')]
    public ?string $legal_name = null;
    #[Validate('nullable|string|min:2|max:50')]
    public ?string $dba = null;
    #[Validate('nullable|date')]
    public ?string $date_of_interview = null;
    #[Validate('nullable')]
    public ?string $interview_method = null;
    #[Validate('nullable')]
    public ?string $contact_1_first_name = null;
    #[Validate('required_with:contact_1_first_name')]
    public ?string $contact_1_last_name = null;
    #[Validate('nullable|string|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i')]
    public ?string $contact_1_phone_number_work = null;
    #[Validate('nullable|integer')]
    public ?string $contact_1_phone_number_work_extension = null;
    #[Validate('nullable|string|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i')]
    public ?string $contact_1_phone_number_mobile = null;
    #[Validate('nullable|email:rfc,dns,spoof,filter')]
    public ?string $contact_1_email = null;
    #[Validate('nullable')]
    public ?string $contact_2_first_name = null;
    #[Validate('required_with:contact_2_first_name')]
    public ?string $contact_2_last_name = null;
    #[Validate('nullable|string|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i')]
    public ?string $contact_2_phone_number_work = null;
    #[Validate('nullable|integer')]
    public ?string $contact_2_phone_number_work_extension = null;
    #[Validate('nullable|string|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i')]
    public ?string $contact_2_phone_number_mobile = null;
    #[Validate('nullable|email:rfc,dns,spoof,filter')]
    public ?string $contact_2_email = null;
    #[Validate('nullable')]
    public ?string $contact_3_first_name = null;
    #[Validate('required_with:contact_3_first_name')]
    public ?string $contact_3_last_name = null;
    #[Validate('nullable|string|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i')]
    public ?string $contact_3_phone_number_work = null;
    #[Validate('nullable|integer')]
    public ?string $contact_3_phone_number_work_extension = null;
    #[Validate('nullable|string|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i')]
    public ?string $contact_3_phone_number_mobile = null;
    #[Validate('nullable|email:rfc,dns,spoof,filter')]
    public ?string $contact_3_email = null;
    #[Validate('nullable')]
    public ?string $contact_4_first_name = null;
    #[Validate('required_with:contact_4_first_name')]
    public ?string $contact_4_last_name = null;
    #[Validate('nullable|string|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i')]
    public ?string $contact_4_phone_number_work = null;
    #[Validate('nullable|integer')]
    public ?string $contact_4_phone_number_work_extension = null;
    #[Validate('nullable|string|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i')]
    public ?string $contact_4_phone_number_mobile = null;
    #[Validate('nullable|email:rfc,dns,spoof,filter')]
    public ?string $contact_4_email = null;
    #[Validate('nullable')]
    public ?string $contact_5_first_name = null;
    #[Validate('required_with:contact_5_first_name')]
    public ?string $contact_5_last_name = null;
    #[Validate('nullable|string|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i')]
    public ?string $contact_5_phone_number_work = null;
    #[Validate('nullable|integer')]
    public ?string $contact_5_phone_number_work_extension = null;
    #[Validate('nullable|string|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i')]
    public ?string $contact_5_phone_number_mobile = null;
    #[Validate('nullable|email:rfc,dns,spoof,filter')]
    public ?string $contact_5_email = null;
    #[Validate('nullable')]
    public ?string $general_notes = null;
    #[Validate('nullable')]
    public ?string $client_list = null;
    #[Validate('nullable')]
    public ?string $location_types = null;
    #[Validate('nullable')]
    public ?string $required_trades = null;
    #[Validate('nullable')]
    public ?string $primary_location_locales = null;
    #[Validate('nullable')]
    public ?string $average_do_not_exceed = null;
    #[Validate('nullable')]
    public ?string $onsite_protocol = null;
    public bool $complete = false;

    public function mount(): void
    {
        $this->interviewMethodTypes = ['in person', 'phone', 'video call'];
    }

    public function store()
    {
        if (is_null($this->date_of_interview)) {
            $this->complete = false;
        } else {
            $this->complete = true;
        }

        $validated = $this->validate([
            'legal_name' => ['required', 'string', 'min:2', 'max:50'],
            'dba' => ['nullable', 'string', 'min:2'],
            'date_of_interview' => ['nullable', 'date'],
            'interview_method' => ['nullable', Rule::in($this->interviewMethodTypes)],
            'contact_1_first_name' => ['nullable'],
            'contact_1_last_name' => ['required_with:contact_1_first_name'],
            'contact_1_phone_number_work' => ['nullable', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i'],
            'contact_1_phone_number_work_extension' => ['nullable', 'integer'],
            'contact_1_phone_number_mobile' => ['nullable', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i'],
            'contact_1_email' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'contact_2_first_name' => ['nullable'],
            'contact_2_last_name' => ['required_with:contact_2_first_name'],
            'contact_2_phone_number_work' => ['nullable', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i'],
            'contact_2_phone_number_work_extension' => ['nullable', 'integer'],
            'contact_2_phone_number_mobile' => ['nullable', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i'],
            'contact_2_email' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'contact_3_first_name' => ['nullable'],
            'contact_3_last_name' => ['required_with:contact_3_first_name'],
            'contact_3_phone_number_work' => ['nullable', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i'],
            'contact_3_phone_number_work_extension' => ['nullable', 'integer'],
            'contact_3_phone_number_mobile' => ['nullable', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i'],
            'contact_3_email' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'contact_4_first_name' => ['nullable'],
            'contact_4_last_name' => ['required_with:contact_4_first_name'],
            'contact_4_phone_number_work' => ['nullable', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i'],
            'contact_4_phone_number_work_extension' => ['nullable', 'integer'],
            'contact_4_phone_number_mobile' => ['nullable', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i'],
            'contact_4_email' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'contact_5_first_name' => ['nullable'],
            'contact_5_last_name' => ['required_with:contact_5_first_name'],
            'contact_5_phone_number_work' => ['nullable', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i'],
            'contact_5_phone_number_work_extension' => ['nullable', 'integer'],
            'contact_5_phone_number_mobile' => ['nullable', 'string', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i'],
            'contact_5_email' => ['nullable', 'email:rfc,dns,spoof,filter'],
            'general_notes' => ['nullable'],
            'client_list' => ['nullable'],
            'location_types' => ['nullable'],
            'required_trades' => ['nullable'],
            'primary_location_locales' => ['nullable'],
            'average_do_not_exceed' => ['nullable'],
            'onsite_protocol' => ['nullable'],
            'complete' => ['boolean'],
        ]);

        if (auth()->user()->potentialClient()->create($validated)) {
            $this->dispatch('potential-client-created');

            request()->session()->flash('toast', 'Potential client successfully created!');
            request()->session()->flash('toast_type', 'success');

            return redirect()->route('Employee.potential-clients.index');
        } else {
            request()->session()->flash('toast', 'Potential client successfully created!');
            request()->session()->flash('toast_type', 'warn');

            back();
        }
    }

    public function saveEditorData($data, $prop)
    {
        $this->{$prop} = $data;
        if ($this->{$prop} === $data) {
            return true;
        } else {
            return false;
        }
        return false;
    }
}; ?>

<div>
    <style>
        div[autoloader="header"]{
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--ck-color-toolbar-background);
            border: 1px solid var(--ck-color-toolbar-border);
            padding: 10px;
            border-radius: var(--ck-border-radius);
            /*margin-top: -1.5em;*/
            border-top: 0;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        div[autoloader="status-spinner"] {
            display: flex;
            align-items: center;
            position: relative;
        }

        span[autoloader="status-spinner-label"] {
            position: relative;
        }

        span[autoloader="status-spinner-label"]::after {
            content: 'Saved!';
            color: green;
            display: inline-block;
            margin-right: var(--ck-spacing-medium);
        }

        /* During "Saving" display spinner and change content of label. */
        div[autoloader^="container"].busy span[autoloader="status-spinner-label"]::after {
            content: 'Saving...';
            color: red;
        }

        div[autoloader^="container"].busy span[autoloader="status-spinner-loader"] {
            display: block;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border-top: 3px solid hsl(0, 0%, 70%);
            border-right: 2px solid transparent;
            animation: autosave-status-spinner 1s linear infinite;
        }

        div[autoloader^="container"] {
            display: flex;
            align-items: center;
        }

        div[autoloader="status-label"] {
            font-weight: bold;
            margin-right: var(--ck-spacing-medium);
        }

        @keyframes autosave-status-spinner {
            to {
                transform: rotate( 360deg );
            }
        }
    </style>

    <form wire:submit="store" class="needs-validation" novalidate autocomplete="off">
        <!-- Basic data header -->
        <h1 class="tw-text-xl">Basic data</h1>

        <!-- Basic data -->
        <div class="row g-2">

            <!-- Legal name -->
            <x-custom.input cols="col-lg-3" id="legal-name" model="legal_name" label="Legal name" class="{{ ($errors->get('legal_name')) ? 'is-invalid' : '' }}" />

            <!-- DBA -->
            <x-custom.input cols="col-lg-3" id="dba" model="dba" label="DBA" class="{{ ($errors->get('dba')) ? 'is-invalid' : '' }}" />

            <!-- Date of interview -->
            <x-custom.input type="date" id="date-of-interview" model="date_of_interview" label="Date of interview" class="{{ ($errors->get('date_of_interview')) ? 'is-invalid' : '' }}" />


            <!-- Interview method -->
            <x-custom.select id="interview-method" model="interview_method" label="Interview method" class="{{ ($errors->get('interview_method')) ? 'is-invalid' : '' }}">
                <option></option>
                @foreach ($interviewMethodTypes as $method)
                    <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                @endforeach
            </x-custom.select>

        </div>

        <x-custom.hr />

        <h1 class="tw-text-xl">Contacts</h1>

        <h4>Contact 1</h4>

        <div class="row g-2">

            <!-- Contact 1 first name -->
            <x-custom.input cols="col-lg-3" id="contact-1-first-name" model="contact_1_first_name" label="First name" class="{{ ($errors->get('contact_1_first_name')) ? 'is-invalid' : '' }}" />

            <!-- Contact 1 last name -->
            <x-custom.input cols="col-lg-3" id="contact-1-last-name" model="contact_1_last_name" label="Last name" class="{{ ($errors->get('contact_1_last_name')) ? 'is-invalid' : '' }}" />

            <!-- Contact 1 work phone -->
            <x-custom.input type="tel" id="contact-1-phone-number-work" model="contact_1_phone_number_work" label="Work phone" class="{{ ($errors->get('contact_1_phone_number_work')) ? 'is-invalid' : '' }}" x-mask="999-999-9999" />

            <!-- Contact 1 work phone extension -->
            <x-custom.input id="contact-1-phone-number-work-extension" model="contact_1_phone_number_work_extension" label="Extension" class="{{ ($errors->get('contact_1_phone_number_work_extension')) ? 'is-invalid' : '' }}" x-mask="999999" />

            <!-- Contact 1 phone mobile -->
            <x-custom.input type="tel" id="contact-1-phone-number-mobile" model="contact_1_phone_number_mobile" label="Mobile phone" class="{{ ($errors->get('contact_1_phone_number_mobile')) ? 'is-invalid' : '' }}" x-mask="999-999-9999" />

        </div>

        <div class="row g-2">

            <!-- Contact 1 email -->
            <x-custom.input cols="col-lg-3" type="email" id="contact-1-email" model="contact_1_email" label="Email" class="{{ ($errors->get('contact_1_email')) ? 'is-invalid' : '' }}" />

        </div>

        <x-custom.hr />

        <h4>Contact 2</h4>

        <div class="row g-2">

            <!-- Contact 2 first name -->
            <x-custom.input cols="col-lg-3" id="contact-2-first-name" model="contact_2_first_name" label="First name" class="{{ ($errors->get('contact_2_first_name')) ? 'is-invalid' : '' }}" />

            <!-- Contact 2 last name -->
            <x-custom.input cols="col-lg-3" id="contact-2-last-name" model="contact_2_last_name" label="Last name" class="{{ ($errors->get('contact_2_last_name')) ? 'is-invalid' : '' }}" />

            <!-- Contact 2 work phone -->
            <x-custom.input type="tel" id="contact-2-phone-number-work" model="contact_2_phone_number_work" label="Work phone" class="{{ ($errors->get('contact_2_phone_number_work')) ? 'is-invalid' : '' }}" x-mask="999-999-9999" />

            <!-- Contact 2 work phone extension -->
            <x-custom.input id="contact-2-phone-number-work-extension" model="contact_2_phone_number_work_extension" label="Extension" class="{{ ($errors->get('contact_2_phone_number_work_extension')) ? 'is-invalid' : '' }}" x-mask="999999" />

            <!-- Contact 2 phone mobile -->
            <x-custom.input type="tel" id="contact-2-phone-number-mobile" model="contact_2_phone_number_mobile" label="Mobile phone" class="{{ ($errors->get('contact_2_phone_number_mobile')) ? 'is-invalid' : '' }}" x-mask="999-999-9999" />

        </div>

        <div class="row g-2">

            <!-- Contact 2 email -->
            <x-custom.input cols="col-lg-3" type="email" id="contact-2-email" model="contact_2_email" label="Email" class="{{ ($errors->get('contact_2_email')) ? 'is-invalid' : '' }}" />

        </div>

        <x-custom.hr />

        <h4>Contact 3</h4>

        <div class="row g-2">

            <!-- Contact 3 first name -->
            <x-custom.input cols="col-lg-3" id="contact-3-first-name" model="contact_3_first_name" label="First name" class="{{ ($errors->get('contact_3_first_name')) ? 'is-invalid' : '' }}" />

            <!-- Contact 3 last name -->
            <x-custom.input cols="col-lg-3" id="contact-3-last-name" model="contact_3_last_name" label="Last name" class="{{ ($errors->get('contact_3_last_name')) ? 'is-invalid' : '' }}" />

            <!-- Contact 3 work phone -->
            <x-custom.input type="tel" id="contact-3-phone-number-work" model="contact_3_phone_number_work" label="Work phone" class="{{ ($errors->get('contact_3_phone_number_work')) ? 'is-invalid' : '' }}" x-mask="999-999-9999" />

            <!-- Contact 3 work phone extension -->
            <x-custom.input id="contact-3-phone-number-work-extension" model="contact_3_phone_number_work_extension" label="Extension" class="{{ ($errors->get('contact_3_phone_number_work_extension')) ? 'is-invalid' : '' }}" x-mask="999999" />

            <!-- Contact 3 phone mobile -->
            <x-custom.input type="tel" id="contact-3-phone-number-mobile" model="contact_3_phone_number_mobile" label="Mobile phone" class="{{ ($errors->get('contact_3_phone_number_mobile')) ? 'is-invalid' : '' }}" x-mask="999-999-9999" />

        </div>

        <div class="row g-2">

            <!-- Contact 3 email -->
            <x-custom.input cols="col-lg-3" type="email" id="contact-3-email" model="contact_3_email" label="Email" class="{{ ($errors->get('contact_3_email')) ? 'is-invalid' : '' }}" />

        </div>

        <x-custom.hr />

        <h4>Contact 4</h4>

        <div class="row g-2">

            <!-- Contact 4 first name -->
            <x-custom.input cols="col-lg-3" id="contact-4-first-name" model="contact_4_first_name" label="First name" class="{{ ($errors->get('contact_4_first_name')) ? 'is-invalid' : '' }}" />

            <!-- Contact 4 last name -->
            <x-custom.input cols="col-lg-3" id="contact-4-last-name" model="contact_4_last_name" label="Last name" class="{{ ($errors->get('contact_4_last_name')) ? 'is-invalid' : '' }}" />

            <!-- Contact 4 work phone -->
            <x-custom.input type="tel" id="contact-4-phone-number-work" model="contact_4_phone_number_work" label="Work phone" class="{{ ($errors->get('contact_4_phone_number_work')) ? 'is-invalid' : '' }}" x-mask="999-999-9999" />

            <!-- Contact 4 work phone extension -->
            <x-custom.input id="contact-4-phone-number-work-extension" model="contact_4_phone_number_work_extension" label="Extension" class="{{ ($errors->get('contact_4_phone_number_work_extension')) ? 'is-invalid' : '' }}" x-mask="999999" />

            <!-- Contact 4 phone mobile -->
            <x-custom.input type="tel" id="contact-4-phone-number-mobile" model="contact_4_phone_number_mobile" label="Mobile phone" class="{{ ($errors->get('contact_4_phone_number_mobile')) ? 'is-invalid' : '' }}" x-mask="999-999-9999" />

        </div>

        <div class="row g-2">

            <!-- Contact 4 email -->
            <x-custom.input cols="col-lg-3" type="email" id="contact-4-email" model="contact_4_email" label="Email" class="{{ ($errors->get('contact_4_email')) ? 'is-invalid' : '' }}" />

        </div>

        <x-custom.hr />

        <h4>Contact 5</h4>

        <div class="row g-2">

            <!-- Contact 5 first name -->
            <x-custom.input cols="col-lg-3" id="contact-5-first-name" model="contact_5_first_name" label="First name" class="{{ ($errors->get('contact_5_first_name')) ? 'is-invalid' : '' }}" />

            <!-- Contact 5 last name -->
            <x-custom.input cols="col-lg-3" id="contact-5-last-name" model="contact_5_last_name" label="Last name" class="{{ ($errors->get('contact_5_last_name')) ? 'is-invalid' : '' }}" />

            <!-- Contact 5 work phone -->
            <x-custom.input type="tel" id="contact-5-phone-number-work" model="contact_5_phone_number_work" label="Work phone" class="{{ ($errors->get('contact_5_phone_number_work')) ? 'is-invalid' : '' }}" x-mask="999-999-9999" />

            <!-- Contact 5 work phone extension -->
            <x-custom.input id="contact-5-phone-number-work-extension" model="contact_5_phone_number_work_extension" label="Extension" class="{{ ($errors->get('contact_5_phone_number_work_extension')) ? 'is-invalid' : '' }}" x-mask="999999" />

            <!-- Contact 5 phone mobile -->
            <x-custom.input type="tel" id="contact-5-phone-number-mobile" model="contact_5_phone_number_mobile" label="Mobile phone" class="{{ ($errors->get('contact_5_phone_number_mobile')) ? 'is-invalid' : '' }}" x-mask="999-999-9999" />

        </div>

        <div class="row g-2">

            <!-- Contact 5 email -->
            <x-custom.input cols="col-lg-3" type="email" id="contact-5-email" model="contact_5_email" label="Email" class="{{ ($errors->get('contact_5_email')) ? 'is-invalid' : '' }}" />

        </div>

        <x-custom.hr />

        <!-- General notes -->
        <x-custom.cke id="general-notes" label="General notes" />

        <x-custom.hr />

        <!-- Client list -->
        <x-custom.cke id="client-list" label="Client list" />

        <x-custom.hr />

        <!-- Location types -->
        <x-custom.cke id="location-types" label="Location types" />

        <x-custom.hr />

        <!-- Required trades -->
        <x-custom.cke id="required-trades" label="Required trades" />

        <x-custom.hr />

        <!-- Primary location locales -->
        <x-custom.cke id="primary-location-locales" label="Primary location locales" />

        <x-custom.hr />

        <!-- Average do not exceed -->
        <x-custom.cke id="average-do-not-exceed" label="Average do not exceeds" />

        <x-custom.hr />

        <!-- Onsite protocol -->
        <x-custom.cke id="onsite-protocol" label="Onsite protocol" />

        <x-custom.hr />

        <!-- Submit -->
        <x-custom.submit />
    </form>

    @assets
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    @endassets
    @script
    <script>
        const generalNotesEl = document.querySelector('#general-notes');
        const generalNotesIndicator = document.querySelector( '[autoloader="container-general-notes"]' )
        const generalNotesId = 'general_notes'
        const clientListEl = document.querySelector('#client-list');
        const clientListIndicator = document.querySelector( '[autoloader="container-client-list"]' )
        const clientListId = 'client_list'
        const locationTypesEl = document.querySelector('#location-types');
        const locationTypesIndicator = document.querySelector( '[autoloader="container-location-types"]' )
        const locationTypesId = 'location_types'
        const requiredTradesEl = document.querySelector('#required-trades');
        const requiredTradesIndicator = document.querySelector( '[autoloader="container-required-trades"]' )
        const requiredTradesId = 'required_trades'
        const primaryLocationLocalesEl = document.querySelector('#primary-location-locales');
        const primaryLocationLocalesIndicator = document.querySelector( '[autoloader="container-primary-location-locales"]' )
        const primaryLocationLocalesId = 'primary_location_locales'
        const averageDoNotExceedEl = document.querySelector('#average-do-not-exceed');
        const averageDoNotExceedIndicator = document.querySelector( '[autoloader="container-average-do-not-exceed"]' )
        const averageDoNotExceedId = 'average_do_not_exceed'
        const onsiteProtocolEl = document.querySelector('#onsite-protocol');
        const onsiteProtocolIndicator = document.querySelector( '[autoloader="container-onsite-protocol"]' )
        const onsiteProtocolId = 'onsite_protocol'

        const generalNotesEditor = await CKSource.Editor
            .create(generalNotesEl, {
                autosave: {
                    save( editor ) {
                        return saveData(editor.getData(), generalNotesId)
                    }
                },
                codeBlock: {
                    languages: [
                        { language: 'css', label: 'CSS' },
                        { language: 'html', label: 'HTML' },
                        { language: 'javascript', label: 'Javascript' },
                        { language: 'php', label: 'PHP' },
                    ],
                },
                mediaEmbend:{
                    providers: ['dailymotion', 'spotify', 'youtube', 'vimeo'],
                },
                removePlugins: ["MediaEmbedToolbar"],
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', 'highlight',
                        '|', 'alignment',
                        '|', 'inserttable', 'mediaembed',
                        '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                        '|', 'link', 'blockQuote', 'codeBlock',
                        '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent',
                        '|', 'findandreplace', 'accessibilityhelp'
                    ],
                },
            } )
            .then(editor => {
                displayStatus( editor, generalNotesIndicator )
            })
            .catch( e => {
                console.error(e)
            })

        const clientListEditor = await CKSource.Editor
            .create(clientListEl, {
                autosave: {
                    save( editor ) {
                        return saveData(editor.getData(), clientListId)
                    }
                },
                codeBlock: {
                    languages: [
                        { language: 'css', label: 'CSS' },
                        { language: 'html', label: 'HTML' },
                        { language: 'javascript', label: 'Javascript' },
                        { language: 'php', label: 'PHP' },
                    ],
                },
                mediaEmbend:{
                    providers: ['dailymotion', 'spotify', 'youtube', 'vimeo'],
                },
                removePlugins: ["MediaEmbedToolbar"],
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', 'highlight',
                        '|', 'alignment',
                        '|', 'inserttable', 'mediaembed',
                        '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                        '|', 'link', 'blockQuote', 'codeBlock',
                        '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent',
                        '|', 'findandreplace', 'accessibilityhelp'
                    ],
                },
            } )
            .then(editor => {
                displayStatus( editor, clientListIndicator )
            })
            .catch( e => {
                console.error(e)
            })

        const locationTypesEditor = await CKSource.Editor
            .create(locationTypesEl, {
                autosave: {
                    save( editor ) {
                        return saveData(editor.getData(), locationTypesId)
                    }
                },
                codeBlock: {
                    languages: [
                        { language: 'css', label: 'CSS' },
                        { language: 'html', label: 'HTML' },
                        { language: 'javascript', label: 'Javascript' },
                        { language: 'php', label: 'PHP' },
                    ],
                },
                mediaEmbend:{
                    providers: ['dailymotion', 'spotify', 'youtube', 'vimeo'],
                },
                removePlugins: ["MediaEmbedToolbar"],
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', 'highlight',
                        '|', 'alignment',
                        '|', 'inserttable', 'mediaembed',
                        '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                        '|', 'link', 'blockQuote', 'codeBlock',
                        '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent',
                        '|', 'findandreplace', 'accessibilityhelp'
                    ],
                },
            } )
            .then(editor => {
                displayStatus( editor, locationTypesIndicator )
            })
            .catch( e => {
                console.error(e)
            })

        const requiredTradesEditor = await CKSource.Editor
            .create(requiredTradesEl, {
                autosave: {
                    save( editor ) {
                        return saveData(editor.getData(), requiredTradesId)
                    }
                },
                codeBlock: {
                    languages: [
                        { language: 'css', label: 'CSS' },
                        { language: 'html', label: 'HTML' },
                        { language: 'javascript', label: 'Javascript' },
                        { language: 'php', label: 'PHP' },
                    ],
                },
                mediaEmbend:{
                    providers: ['dailymotion', 'spotify', 'youtube', 'vimeo'],
                },
                removePlugins: ["MediaEmbedToolbar"],
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', 'highlight',
                        '|', 'alignment',
                        '|', 'inserttable', 'mediaembed',
                        '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                        '|', 'link', 'blockQuote', 'codeBlock',
                        '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent',
                        '|', 'findandreplace', 'accessibilityhelp'
                    ],
                },
            } )
            .then(editor => {
                displayStatus( editor, requiredTradesIndicator )
            })
            .catch( e => {
                console.error(e)
            })

        const primaryLocationLocalesEditor = await CKSource.Editor
            .create(primaryLocationLocalesEl, {
                autosave: {
                    save( editor ) {
                        return saveData(editor.getData(), primaryLocationLocalesId)
                    }
                },
                codeBlock: {
                    languages: [
                        { language: 'css', label: 'CSS' },
                        { language: 'html', label: 'HTML' },
                        { language: 'javascript', label: 'Javascript' },
                        { language: 'php', label: 'PHP' },
                    ],
                },
                mediaEmbend:{
                    providers: ['dailymotion', 'spotify', 'youtube', 'vimeo'],
                },
                removePlugins: ["MediaEmbedToolbar"],
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', 'highlight',
                        '|', 'alignment',
                        '|', 'inserttable', 'mediaembed',
                        '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                        '|', 'link', 'blockQuote', 'codeBlock',
                        '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent',
                        '|', 'findandreplace', 'accessibilityhelp'
                    ],
                },
            } )
            .then(editor => {
                displayStatus( editor, primaryLocationLocalesIndicator )
            })
            .catch( e => {
                console.error(e)
            })

        const averageDoNotExceedEditor = await CKSource.Editor
            .create(averageDoNotExceedEl, {
                autosave: {
                    save( editor ) {
                        return saveData(editor.getData(), averageDoNotExceedId)
                    }
                },
                codeBlock: {
                    languages: [
                        { language: 'css', label: 'CSS' },
                        { language: 'html', label: 'HTML' },
                        { language: 'javascript', label: 'Javascript' },
                        { language: 'php', label: 'PHP' },
                    ],
                },
                mediaEmbend:{
                    providers: ['dailymotion', 'spotify', 'youtube', 'vimeo'],
                },
                removePlugins: ["MediaEmbedToolbar"],
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', 'highlight',
                        '|', 'alignment',
                        '|', 'inserttable', 'mediaembed',
                        '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                        '|', 'link', 'blockQuote', 'codeBlock',
                        '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent',
                        '|', 'findandreplace', 'accessibilityhelp'
                    ],
                },
            } )
            .then(editor => {
                displayStatus( editor, averageDoNotExceedIndicator )
            })
            .catch( e => {
                console.error(e)
            })

        const onsiteProtocolEditor = await CKSource.Editor
            .create(onsiteProtocolEl, {
                autosave: {
                    save( editor ) {
                        return saveData(editor.getData(), onsiteProtocolId)
                    }
                },
                codeBlock: {
                    languages: [
                        { language: 'css', label: 'CSS' },
                        { language: 'html', label: 'HTML' },
                        { language: 'javascript', label: 'Javascript' },
                        { language: 'php', label: 'PHP' },
                    ],
                },
                mediaEmbend:{
                    providers: ['dailymotion', 'spotify', 'youtube', 'vimeo'],
                },
                removePlugins: ["MediaEmbedToolbar"],
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', 'highlight',
                        '|', 'alignment',
                        '|', 'inserttable', 'mediaembed',
                        '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                        '|', 'link', 'blockQuote', 'codeBlock',
                        '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent',
                        '|', 'findandreplace', 'accessibilityhelp'
                    ],
                },
            } )
            .then(editor => {
                displayStatus( editor, onsiteProtocolIndicator )
            })
            .catch( e => {
                console.error(e)
            })

        function saveData(data, model)
        {
            return new Promise( resolve => {
                console.log(data, model)
                let res = $wire.saveEditorData(data, model)
                if (res) {
                    resolve()
                } else {
                    return false;
                }
            })
        }

        function displayStatus( editor, el ) {
            const pendingActions = editor.plugins.get( 'PendingActions' )
            pendingActions.on( 'change:hasAny', ( evt, propertyName, newValue ) =>{
                if ( newValue ) {
                    el.classList.add( 'busy' )
                } else {
                    el.classList.remove( 'busy' )
                }
            } )
        }
    </script>
    @endscript
</div>
