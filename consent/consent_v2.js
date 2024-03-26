const COOKIE_NAME = 'cookieConsentGlobalHolder';
const LOCAL_STORAGE_COOKIE_NAME = 'cookieConsentGlobal';
const WIDGET_MAIN_COLOR = '#1032cf';
const WIDGET_SECOND_COLOR = '#202020';
const COOKIE_CONSENT_CATEGORY_SIMPLE_TYPE = true;
const COOKIE_CONSENT_ALLOW_ALL = true;

const COOKIE_CONSENT_CATEGORY_TYPES_EXTENDED = {
    necessary: true,
    preferences: COOKIE_CONSENT_ALLOW_ALL,
    statistics: COOKIE_CONSENT_ALLOW_ALL,
    marketing: COOKIE_CONSENT_ALLOW_ALL
};

const COOKIE_CONSENT_CATEGORY_TYPES_SIMPLE = {
    necessary: true,
    optional: COOKIE_CONSENT_ALLOW_ALL
};

const COOKIE_CONSENT_CATEGORY_TYPES = COOKIE_CONSENT_CATEGORY_SIMPLE_TYPE ? COOKIE_CONSENT_CATEGORY_TYPES_SIMPLE : COOKIE_CONSENT_CATEGORY_TYPES_EXTENDED;

const svgCCookie = `<svg id="${COOKIE_NAME}-svg1" fill="#000" height="30px" width="30px" version="1.1"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 299.049 299.049" xml:space="preserve">
                                    <g>
                                        <g>
                                            <g>
                                                <path d="M289.181,206.929c-13.5-12.186-18.511-31.366-12.453-48.699c1.453-4.159-0.94-8.686-5.203-9.82
                                                c-27.77-7.387-41.757-38.568-28.893-64.201c2.254-4.492-0.419-9.898-5.348-10.837
                                                c-26.521-5.069-42.914-32.288-34.734-58.251
                                                c1.284-4.074-1.059-8.414-5.178-9.57C184.243,1.867,170.626,0,156.893,0C74.445,0,7.368,67.076,7.368,149.524
                                                s67.076,149.524,149.524,149.524c57.835,0,109.142-33.056,133.998-83.129C292.4,212.879,291.701,209.204,289.181,206.929z
                                                M156.893,283.899c-74.095,0-134.374-60.281-134.374-134.374S82.799,15.15,156.893,15.15c9.897,0,19.726,1.078,29.311,3.21
                                                c-5.123,29.433,11.948,57.781,39.41,67.502c-9.727,29.867,5.251,62.735,34.745,74.752c-4.104,19.27,1.49,39.104,14.46,53.365
                                                C251.758,256.098,207.229,283.899,156.893,283.899z"/>
                                                <path d="M76.388,154.997c-13.068,0-23.7,10.631-23.7,23.701c0,13.067,10.631,23.7,23.7,23.7c13.067,0,23.7-10.631,23.7-23.7
                                                C100.087,165.628,89.456,154.997,76.388,154.997z M76.388,187.247c-4.715,0-8.55-3.835-8.55-8.55s3.835-8.551,8.55-8.551
                                                c4.714,0,8.55,3.836,8.55,8.551S81.102,187.247,76.388,187.247z"/>
                                                <path d="M173.224,90.655c0-14.9-12.121-27.021-27.02-27.021s-27.021,12.121-27.021,27.021c0,14.898,12.121,27.02,27.021,27.02
                                                C161.104,117.674,173.224,105.553,173.224,90.655z M134.334,90.655c0-6.545,5.325-11.871,11.871-11.871
                                                c6.546,0,11.87,5.325,11.87,11.871s-5.325,11.87-11.87,11.87S134.334,97.199,134.334,90.655z"/>
                                                <path d="M169.638,187.247c-19.634,0-35.609,15.974-35.609,35.61c0,19.635,15.974,35.61,35.609,35.61
                                                c19.635,0,35.61-15.974,35.61-35.61C205.247,203.221,189.273,187.247,169.638,187.247z M169.638,243.315
                                                c-11.281,0-20.458-9.178-20.458-20.46s9.178-20.46,20.458-20.46c11.281,0,20.46,9.178,20.46,20.46
                                                S180.92,243.315,169.638,243.315z"/>
                                            </g>
                                        </g>
                                    </g>
                        </svg>`;



// Check if the user has consented to cookies
function addCustomFontForCookieConsent() {

    if (!document.getElementById('___cookieConsent_roboto_font_link')) {
        // Create a link element
        const fontLink = document.createElement('link');

        // Set the attributes for the link element
        fontLink.rel = 'stylesheet';
        fontLink.href = 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap';
        fontLink.id = '___cookieConsent_roboto_font_link'; // Set an ID for the link element

        // Append the link element to the head of the document
        document.head.appendChild(fontLink);
    }


    // Create a link element
    const fontLink = document.createElement('link');
    // Set the attributes for the link element
    fontLink.rel = 'stylesheet';
    fontLink.href = 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap';
    // Append the link element to the head of the document
    document.head.appendChild(fontLink);
}


// Check if the user has consented to cookies
function hasConsentedToCookies() {
    return localStorage.getItem(LOCAL_STORAGE_COOKIE_NAME) === 'true';
}

// Set consent for cookies
function setCookieConsent(consent) {
    localStorage.setItem(LOCAL_STORAGE_COOKIE_NAME, consent ? 'true' : 'false');
}


function denyOrAllowAllCookieCategorySession(action) {
    // Initialize cookie consent object
    const cookieConsentCategoryTypes = {};

    for (const category in COOKIE_CONSENT_CATEGORY_TYPES) {
        if (Object.hasOwnProperty.call(COOKIE_CONSENT_CATEGORY_TYPES, category)) {
            if (category !== 'neccesary') {
                cookieConsentCategoryTypes[category] = action;
            }
        }
    }

    const cookieConsentString = JSON.stringify(cookieConsentCategoryTypes);
    // Serialize cookieConsentHolder object to JSON string
    const cookieName = COOKIE_NAME;
    const expirationDate = new Date();
    expirationDate.setFullYear(expirationDate.getFullYear() + 1);
    // Set the cookie with the serialized string as its value
    document.cookie = `${cookieName}=${cookieConsentString}; expires=${expirationDate.toUTCString()}; path=/`;

}

function initiateCookieCategorySession() {
    // Initialize cookie consent object
    const cookieConsentCategoryTypes = COOKIE_CONSENT_CATEGORY_TYPES;

    if (document.cookie.indexOf(COOKIE_NAME) === -1) {
        const cookieConsentString = JSON.stringify(cookieConsentCategoryTypes);
        // Serialize cookieConsentHolder object to JSON string
        const cookieName = COOKIE_NAME;
        const expirationDate = new Date();
        expirationDate.setFullYear(expirationDate.getFullYear() + 1);
        // Set the cookie with the serialized string as its value
        document.cookie = `${cookieName}=${cookieConsentString}; expires=${expirationDate.toUTCString()}; path=/`;
    }
}


function checkCookieCategorySession() {
    // Retrieve the value of the cookieConsent cookie
    const cookieConsentCookie = document.cookie.split(';').find(cookie => cookie.trim().startsWith(COOKIE_NAME + '='));

    // If the cookie exists
    if (cookieConsentCookie) {
        const cookieConsentString = cookieConsentCookie.split('=')[1];
        const cookieConsentObject = JSON.parse(cookieConsentString);
        // Loop through each checkbox input and set its checked property based on the cookieConsentObject
        const checkboxes = document.querySelectorAll('.___cookieConsentToggle input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            const cookieCategory = checkbox.name.replace('cookie', '').toLowerCase();
            checkbox.checked = cookieConsentObject[cookieCategory];
        });
    }
}

function setCookieCategoryConsent(category) {
    // Retrieve the value of the cookieConsent cookie
    const cookieConsentCookie = document.cookie.split(';').find(cookie => cookie.trim().startsWith(COOKIE_NAME + '='));
    // If the cookie exists
    if (cookieConsentCookie) {
        const cookieConsentString = cookieConsentCookie.split('=')[1];
        const cookieConsentObject = JSON.parse(cookieConsentString);

        // Update the corresponding property in the cookieConsentObject
        cookieConsentObject[category] = !cookieConsentObject[category];

        // Serialize the updated object back to a string
        const updatedCookieConsentString = JSON.stringify(cookieConsentObject);
        const expirationDate = new Date();
        expirationDate.setFullYear(expirationDate.getFullYear() + 1);

        // Update the cookie with the updated string
        document.cookie = `${COOKIE_NAME}=${updatedCookieConsentString}; expires=${expirationDate.toUTCString()}; path=/`;
        // Update the checked property of the corresponding checkbox input
        const checkbox = document.querySelector(`input[name="${category}"]`);

        if (checkbox) {
            checkbox.checked = cookieConsentObject[category];
        }
    }
}

function displayCookieConsentButton() {
    function getMaxZIndex() {
        let maxZIndex = 0;
        const allElements = document.querySelectorAll('*');

        allElements.forEach(element => {
            const zIndex = parseFloat(window.getComputedStyle(element).zIndex);
            if (!isNaN(zIndex) && zIndex > maxZIndex) {
                maxZIndex = zIndex;
            }
        });

        return maxZIndex++;
    }

    const CONSENT_MODAL_Z_INDEX = getMaxZIndex();

    // Dynamically create style element for consent button
    const style = document.createElement('style');
    style.textContent = `
        #___cookieButtonConsent {
            position: fixed;
            bottom: 20px;
            left: 20px;
            border-radius: 50%;
            padding: 0.5rem;
            cursor: pointer;
            border: 1px solid #ccc;
            background-color: rgba(255, 255, 255, 0.75);
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
            z-index: ${CONSENT_MODAL_Z_INDEX}; /* Ensure the backdrop is behind the modal */
        }
        #___cookieButtonConsent:hover {
        background-color: ${WIDGET_MAIN_COLOR};
        }
        
        #___cookieButtonConsent:hover svg {
            fill: #fff; /* Change the fill color of the SVG */
        }
    `;
    // Append style element to the document head
    document.head.appendChild(style);

    // Create cookie consent button
    const cookieConsentButton = document.createElement('div');
    cookieConsentButton.innerHTML = `
        <div id="___cookieButtonConsent" onclick="showCookieConsentModal()"></div>
    `;
    document.body.appendChild(cookieConsentButton);
    document.querySelector('div#___cookieButtonConsent').insertAdjacentHTML('beforeend', svgCCookie);
}

// Function to display cookie consent modal
function displayCookieConsentModal() {


    function getMaxZIndex() {
        let maxZIndex = 0;
        const allElements = document.querySelectorAll('*');

        allElements.forEach(element => {
            const zIndex = parseFloat(window.getComputedStyle(element).zIndex);
            if (!isNaN(zIndex) && zIndex > maxZIndex) {
                maxZIndex = zIndex;
            }
        });

        return maxZIndex++;
    }

    const CONSENT_MODAL_Z_INDEX = getMaxZIndex();


    // Dynamically create style element for toggle button styling
    const style = document.createElement('style');
    style.textContent = `
        .___cookieConsent__ModalConsentBackdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(5px);
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black color */
            z-index: ${CONSENT_MODAL_Z_INDEX}; /* Ensure the backdrop is behind the modal */
        }
        
        #___cookieConsent__Title {
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            margin-bottom: 0.5rem;
        }
        
        #___cookieConsent__Title svg {
            margin-left: 0.5rem;
            height: 30px;
            width: 30px;
            margin-top: -5px;
            }
    
        #___cookieConsent__ModalConsent { 
            position: fixed; 
            top: 50%; 
            left: 50%; 
            transform: translate(-50%, -50%); 
            background-color: #fff; 
            padding: 20px; 
            border-radius: 15px;
            box-shadow: 0px 0px 2rem rgba(0, 0, 0, 0.5); /* Add shadow */
            width:50%; 
            max-width: 800px !important; 
            font-family: 'Roboto', sans-serif;
            z-index:${CONSENT_MODAL_Z_INDEX}; 
        }
        
        /* Media query for screens with maximum width of 768px (typical for mobile devices) */
            @media screen and (max-width: 768px) {
                #___cookieConsent__ModalConsent {
                    position: fixed;
                    top: unset;
                    bottom: 0; 
                    left: 0;
                    width: 100%; /* Full width of the screen */
                    height: auto; 
                    max-height: 90%; 
                    border-radius: 0px;
                    box-shadow: none; /* remove shadow */
                    overflow: auto;
                    transform: none; /* Remove the centering transform */
                }
                #___cookieConsent__footerButtons {
                    flex-direction: column;
                }
            }
        
        #___cookieConsent__CategoryButtonList {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping to next row if necessary */
            justify-content: space-around;
            margin: 1rem 0;
        }
        

        
         /* Updated CSS styles for toggle buttons */
        .___cookieConsent__ToggleLabel {
            display: flex;
            align-items: center;
            flex-direction: column;
            cursor: pointer;
            margin-bottom: 10px; /* Add some space between toggle buttons */
        }
        
        .___cookieConsent__ToggleLabel span {
            margin-bottom: 10px; /* Add space between label text and toggle button */
        }
        .___cookieConsent__ToggleDivider { 
            width: 1px; 
            background:#ccc; 
        }
        
        .___cookieConsent__Toggle {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }
        
        .___cookieConsent__Toggle:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
        }
        
        .___cookieConsent__Toggle input {
            display: none;
        }
        
        .___cookieConsent__toggleInner {
            position: relative;
            width: 60px;
            height: 30px;
            border-radius: 15px;
            transition: all 0.3s;
            z-index: 2;
        }
        
        .___cookieConsent__toggleHolder {
            position: absolute;
            top:0;
            z-index: 1;
            width: 60px;
            height: 30px;
            border-radius: 15px;
            transition: all 0.3s;
        }
        
       /* For unchecked state */
        .___cookieConsent__Toggle input:not(:checked) + .___cookieConsent__toggleHolder .___cookieConsent__toggleInner {
            background-color: #fff;
            width: 28px;
            height: 28px;
            margin-top: 1px;
            margin-left: 1px;
        }
        
        .___cookieConsent__Toggle input:not(:checked) + .___cookieConsent__toggleHolder {
            background-color: lightgrey;
        }
        
        /* For checked state */
        .___cookieConsent__Toggle input:checked + .___cookieConsent__toggleHolder .___cookieConsent__toggleInner {
            background-color: #fff;
            width: 28px;
            height: 28px;
            margin-top: 1px;
            margin-left: 30px;
        }
        
        .___cookieConsent__Toggle input:checked + .___cookieConsent__toggleHolder {
            background-color: ${WIDGET_MAIN_COLOR};
        }
        
        
        /* For disabled state */
        .___cookieConsent__Toggle input:disabled + .___cookieConsent__toggleHolder .___cookieConsent__toggleInner {
            background-color: #fff;
            width: 28px;
            height: 28px;
            margin-top: 1px;
            margin-left: 30px;
        }
        
         .___cookieConsent__Toggle input:disabled + .___cookieConsent__toggleHolder {
            background-color: black;
        }
        .___cookieConsent__Toggle input:disabled + .___cookieConsent__toggleHolder:hover {
            cursor: not-allowed;
        }

        
        #___cookieConsent__TabButtons, #___cookieConsent__footerButtons {
            display: flex;
            flex-wrap: wrap; /* Allow wrapping to next row if necessary */
            justify-content: space-around;
        }
        #___cookieConsent__footerButtons {gap:1rem; margin-top:1rem}
        .___cookieConsent__Tab {
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: normal;
            line-height: 1.5rem;
            display: flex;
            flex: 1 auto;
            text-align: center;
            justify-content: center;
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 1px solid #ccc;
            border-radius: 5px 5px 0 0;
        }
        .___cookieConsent__Tab:hover { cursor: pointer;}
        .___cookieConsent__Tab.active {
            background-color: #fff;
            border: 1px solid #ccc;
            border-bottom: none;
        }
        .___cookieConsent__consentButton {
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: normal;
            line-height: 1.5rem;
            display: flex;
            flex: 1 auto;
            text-align: center;
            justify-content: center;
            padding: 10px 20px;
            cursor: pointer;
            background-color: ${WIDGET_MAIN_COLOR};
            border: 1px solid ${WIDGET_MAIN_COLOR};
            color:white;
            outline: none;
            border-radius: 5px;
        }    
        .___cookieConsent__consentButton.___cookieConsent__deny {
            border: 1px solid ${WIDGET_MAIN_COLOR};
            color: ${WIDGET_MAIN_COLOR};
            background-color: unset !important;
        }     
         .___cookieConsent__consentButton:hover, .___cookieConsent__deny:hover { 
            background-color:  ${WIDGET_SECOND_COLOR} !important; 
            border: 1px solid ${WIDGET_SECOND_COLOR}; 
            color:white;
            cursor: pointer;
        }   
        
        #___cookieConsent__TabContent {
            font-size: 1rem;
            font-weight: 400;
            letter-spacing: normal;
            line-height: 1.5rem;
            padding: 1rem;
            border: 1px solid #ccc;
            border-top: none;
        }
        #___cookieConsent__TabContent b {
            font-weight: 700;
        }
        
        #___cookieConsent__Wrapper, #___cookieConsent__AboutTab div, #___cookieConsent__ConsentTab {
        overflow-x:auto;
        max-height:50vh;
        -ms-overflow-style: none;
        scrollbar-width: none;
        }
        
        #___cookieConsent__Wrapper, #___cookieConsent__AboutTab div {
        padding-bottom:1rem;
        }
        
        #___cookieConsent__Wrapper::-webkit-scrollbar, #___cookieConsent__AboutTab::-webkit-scrollbar, #___cookieConsent__ConsentTab::-webkit-scrollbar {
        display: none; 
        }
        
        /* Add white transparent gradient at the bottom */
        #___cookieConsent__DetailsTab, #___cookieConsent__AboutTab {
          position: relative; /* Ensure position context for the gradient */
        }
        #___cookieConsent__DetailsTab::after, #___cookieConsent__AboutTab::after {
          content: '';
          position: absolute;
          bottom: -5px;
          left: 0;
          width: 100%;
          height: 40px; /* Adjust height as needed */
          background: linear-gradient(to bottom, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 1)); /* White transparent gradient */
        }
    `;
    // Append style element to the document head
    document.head.appendChild(style);

    // Create backdrop element
    const backdrop = document.createElement('div');
    backdrop.setAttribute('id', '___cookieConsentBackdrop');
    backdrop.classList.add('___cookieConsent__ModalConsentBackdrop');
    document.body.appendChild(backdrop);

    const EXTENDED_LIST = `
    <div id="___cookieConsent__CategoryButtonList">
        <label for="___cookieConsent__Necessary" class="___cookieConsent__ToggleLabel">
            <span>Necesare</span>
            <div class="___cookieConsent__Toggle">
                <input type="checkbox" id="___cookieConsent__Necessary" name="___cookieConsent__Necessary" value="necessary" checked disabled>
                <div class="___cookieConsent__toggleHolder"><div class="___cookieConsent__toggleInner"></div></div>
            </div>
        </label>
        <div class="___cookieConsent__ToggleDivider"></div>
        <label for="___cookieConsent__Preferences" class="___cookieConsent__ToggleLabel">
            <span>Preferinte</span>
            <div class="___cookieConsent__Toggle">
                <input type="checkbox" id="___cookieConsent__Preferences" name="___cookieConsent__Preferences" value="preferences">
                <div class="___cookieConsent__toggleHolder" onclick="setCookieCategoryConsent('preferences')"><div class="___cookieConsent__toggleInner"></div></div>
            </div>
        </label>
        <div class="___cookieConsent__ToggleDivider"></div>
        <label for="___cookieConsent__Statistics" class="___cookieConsent__ToggleLabel">
            <span>Statistici</span>
            <div class="___cookieConsent__Toggle">
                <input type="checkbox" id="___cookieConsent__Statistics" name="___cookieConsent__Statistics" value="statistics">
                <div class="___cookieConsent__toggleHolder" onclick="setCookieCategoryConsent('statistics')"><div class="___cookieConsent__toggleInner"></div></div>
            </div>
        </label>
        <div class="___cookieConsent__ToggleDivider"></div>
        <label for="___cookieConsent__Marketing" class="___cookieConsent__ToggleLabel">
            <span>Marketing</span>
            <div class="___cookieConsent__Toggle">
                <input type="checkbox" id="___cookieConsent__Marketing" name="___cookieConsent__Marketing" value="marketing">
                <div class="___cookieConsent__toggleHolder" onclick="setCookieCategoryConsent('marketing')"><div class="___cookieConsent__toggleInner"></div></div>
            </div>
        </label>
    </div>`;
    const EXTENDED_LIST_BUTTONS = `
        <button class="___cookieConsent__consentButton" onClick="allowAllCookies()">Accepta toate</button>
        <button class="___cookieConsent__consentButton ___cookieConsent__deny" onClick="denyAllCookies()">Respinge toate</button>
    `;

    const SIMPLE_LIST = `
    <div id="___cookieConsent__CategoryButtonList">
        <label for="___cookieConsent__Necessary" class="___cookieConsent__ToggleLabel">
            <span>Necesare</span>
            <div class="___cookieConsent__Toggle">
                <input type="checkbox" id="___cookieConsent__Necessary" name="___cookieConsent__Necessary" value="necessary" checked disabled>
                <div class="___cookieConsent__toggleHolder"><div class="___cookieConsent__toggleInner"></div></div>
            </div>
        </label>
        <div class="___cookieConsent__ToggleDivider"></div>
        <label for="___cookieConsent__Optional" class="___cookieConsent__ToggleLabel">
            <span>Opționale</span>
            <div class="___cookieConsent__Toggle">
                <input type="checkbox" id="___cookieConsent__Optional" name="___cookieConsent__Optional" value="optional">
                <div class="___cookieConsent__toggleHolder" onclick="setCookieCategoryConsent('optional')"><div class="___cookieConsent__toggleInner"></div></div>
            </div>
        </label>
    </div>`;

    const SIMPLE_LIST_BUTTONS = `<button class="___cookieConsent__consentButton ___cookieConsent__deny" onclick="denyAllCookies()">Respinge toate</button>`;

    // Create cookie consent modal
    const modal = document.createElement('div');
    modal.innerHTML = `
        <div id="___cookieConsent__ModalConsent">
            <div id="___cookieConsent__ModalWrapper">
            <h2 id="___cookieConsent__Title">Folosim cookies</h2>
            <div id="___cookieConsent__TabButtons">
                <div class="___cookieConsent__Tab" onclick="showTab('___cookieConsent__Consent')" id="___cookieConsent__ConsentTabButton">Consimțământ</div>
                <div class="___cookieConsent__Tab" onclick="showTab('___cookieConsent__Details')" id="___cookieConsent__DetailsTabButton">Detalii</div>
                <div class="___cookieConsent__Tab" onclick="showTab('___cookieConsent__About')" id="___cookieConsent__AboutTabButton">Despre</div>
            </div>
            <div id="___cookieConsent__TabContent">
                <div id="___cookieConsent__ConsentTab">
                    <p>Folosim cookie-uri pentru a personaliza continutul si anunturile, pentru a oferi functii de retele sociale si pentru a analiza traficul. De asemenea, le oferim partenerilor de retele sociale, de publicitate si de analize informatii cu privire la modul in care folositi site-ul nostru. Acestia le pot combina cu alte informatii oferite de dvs. sau culese in urma folosirii serviciilor lor.</p>
                    <p>Selecteaza din lista de mai jos:</p>
                    ${COOKIE_CONSENT_CATEGORY_SIMPLE_TYPE ? SIMPLE_LIST : EXTENDED_LIST}
                </div>
                <div id="___cookieConsent__DetailsTab" style="display:none;">
                    <p>Detalii despre cookiurile folosite...</p>
                </div>
                <div id="___cookieConsent__AboutTab" style="display:none;">
                    <div style="display: block">
                    <p>Cookie-urile sunt fișiere text mici care pot fi folosite de către site-uri web pentru a face experiența utilizatorului mai eficientă.</p>    
                    <p>Legea statului prevede că putem stoca cookie-uri pe dispozitivul dvs. dacă acestea sunt strict necesare pentru funcționarea acestui site. Pentru toate celelalte tipuri de cookie-uri avem nevoie de permisiunea dvs. Acest lucru înseamnă că cookie-urile care sunt categorisite ca fiind necesare sunt procesate în conformitate cu GDPR Art. 6 (1) (f). Toate celelalte cookie-uri, adică cele din categoriile preferințe și marketing, sunt procesate în conformitate cu GDPR Art. 6 (1) (a) GDPR.</p>
                    <p>Acest site utilizează diferite tipuri de cookie-uri. Unele cookie-uri sunt plasate de servicii terțe care apar pe paginile noastre.</p>
                    <p>Puteți schimba sau retrage oricând consimțământul dvs. din Declarația de Cookie-uri de pe site-ul nostru.</p>    
                    <p>Aflați mai multe despre cine suntem, cum ne puteți contacta și cum procesăm datele personale în Politica noastră de Confidențialitate.</p>  
                    <p>Vă rugăm să menționați ID-ul și data consimțământului dvs. atunci când ne contactați în legătură cu consimțământul dvs.</p>
                    </div>
                </div>
            </div>
            <div id="___cookieConsent__footerButtons">
                <button class="___cookieConsent__consentButton" onclick="acceptSelectionCookies()">Accepta selecția</button>
                ${COOKIE_CONSENT_CATEGORY_SIMPLE_TYPE ? SIMPLE_LIST_BUTTONS : EXTENDED_LIST_BUTTONS}
    </div>
        </div>
      </div>
    `;
    document.body.appendChild(modal);
    document.querySelector('h2#___cookieConsent__Title').insertAdjacentHTML('beforeend', svgCCookie);
    // Open the Consent tab by default
    showTab('___cookieConsent__Consent');
}

// Function to close cookie consent modal
function closeCookieModal() {
    document.getElementById('___cookieConsent__ModalConsent').remove();
    document.getElementById('___cookieConsentBackdrop').remove();
}

// Function to show a specific tab in the cookie consent modal
function showTab(tabName) {
    //console.log(tabName)
    const tabButtons = document.querySelectorAll('.___cookieConsent__Tab');
    tabButtons.forEach(tabButton => {
        tabButton.classList.remove('active');
    });

    const clickedTabButton = document.getElementById(tabName + 'TabButton'); // This line should be changed
    clickedTabButton.classList.add('active');

    const tabContent = document.querySelectorAll('#___cookieConsent__TabContent > div');
    tabContent.forEach(tab => {
        tab.style.display = 'none';
    });
    document.getElementById(tabName + 'Tab').style.display = 'block';

    // If Details tab is shown, display cookie details
    if (tabName === '___cookieConsent__Details') {
        displayCookieDetails();
    }
}


// Function to read current cookies and display them in the Details tab
function displayCookieDetails() {
    let cookies = document.cookie.split(';'); // Split cookies into an array
    //console.log(cookies);

    let cookieDetailsHtml = ''; // Variable to store the HTML for the cookie details

    // Loop through each cookie
    cookies.forEach(function (cookie) {
        // Trim any leading or trailing whitespace
        cookie = cookie.trim();

        // Split the cookie into name and value
        let parts = cookie.split('=');
        let name = parts[0].trim(); // Get cookie name
        let value = parts.slice(1).join('=').trim(); // Get cookie value

        // Determine the type of cookie
        let type = '';
        if (name === 'cookieConsentGlobalHolder') {
            type = 'necessary';
        } else if (name === 'PHPSESSID') {
            type = 'necessary';
        }  else {
            // Add logic to determine other types based on cookie name or value if needed
        }

        // Create HTML for the cookie details and add it to the cookieDetailsHtml variable
        cookieDetailsHtml += '<b>Cookie Name:</b> ' + name + '<br>';
        cookieDetailsHtml += '<b>Value:</b> ' + value + '<br>';
        cookieDetailsHtml += '<b>Type:</b> ' + type + '<br><br>';
    });

    // Display the cookie details in the Details tab
    document.getElementById('___cookieConsent__DetailsTab').innerHTML = '<div id="___cookieConsent__Wrapper">' + cookieDetailsHtml + '</div>';
}

// Function to deny cookies
function acceptSelectionCookies() {
    setCookieConsent(true);
    closeCookieModal();
}

// Function to deny all cookies
function denyAllCookies() {
    setCookieConsent(false);
    denyOrAllowAllCookieCategorySession(false);

    closeCookieModal();
}

// Function to allow all cookies
function allowAllCookies() {
    setCookieConsent(true);
    denyOrAllowAllCookieCategorySession(true);
    closeCookieModal();
}

// Function to show modal from button
function showCookieConsentModal() {
    addCustomFontForCookieConsent();
    displayCookieConsentModal();
    setTimeout(() => {
        checkCookieCategorySession();
    }, 500); // Adjust the delay as needed
}

// Check if user has already consented to cookies
window.onload = function () {
    displayCookieConsentButton();
    if (!hasConsentedToCookies()) {
        displayCookieConsentModal();
        addCustomFontForCookieConsent();
    }
    initiateCookieCategorySession();
    setTimeout(() => {
        checkCookieCategorySession();
    }, 500); // Adjust the delay as needed


};
