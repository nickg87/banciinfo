const COOKIE_NAME = 'cookieConsentGlobalHolder';
const LOCAL_STORAGE_COOKIE_NAME = 'cookieConsentGlobal';
const LOCAL_STORAGE_COOKIE_SEND = 'cookieConsentGlobal_send';
const WIDGET_MAIN_COLOR = '#2f9d08';
const WIDGET_SECOND_COLOR = '#202020';
const COOKIE_CONSENT_CATEGORY_SIMPLE_TYPE = false;
const COOKIE_CONSENT_ALLOW_ALL = false;

const COOKIE_CONSENT_GOOGLE_PARTNER = {
    ad_storage: COOKIE_CONSENT_ALLOW_ALL ? "granted" : "denied",
    ad_user_data: COOKIE_CONSENT_ALLOW_ALL ? "granted" : "denied",
    ad_personalization: COOKIE_CONSENT_ALLOW_ALL ? "granted" : "denied",
    analytics_storage: COOKIE_CONSENT_ALLOW_ALL ? "granted" : "denied",
    functionality_storage: "granted",
    personalization_storage: "granted"
};

const PARTNER_EXCEPTIONS = [
    'functionality_storage',
    'personalization_storage'
];

const COOKIE_CONSENT_CATEGORY_TYPES_EXTENDED = {
    necessary: true,
    preferences: COOKIE_CONSENT_ALLOW_ALL,
    statistics: COOKIE_CONSENT_ALLOW_ALL,
    marketing: COOKIE_CONSENT_ALLOW_ALL,
    gc: COOKIE_CONSENT_GOOGLE_PARTNER
};


const COOKIE_CONSENT_CATEGORY_TYPES_SIMPLE = {
    necessary: true,
    optional: COOKIE_CONSENT_ALLOW_ALL,
    gc: COOKIE_CONSENT_GOOGLE_PARTNER
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


// Define dataLayer and the gtag function.
window.dataLayer = window.dataLayer || [];

// Set default consent to 'denied' as a placeholder
// Determine actual values based on your own requirements
if (typeof window.gtag === 'function') {
    window.gtag('consent', 'default', {
        'analytics': "denied",
        'analytics_storage': "denied",
        'ad_storage': "denied",
        'ad_user_data': "denied",
        'ad_personalization': "denied"
    });
} else {
    console.warn('window.gtag is not defined or is not a function.');
}


// Check if the user has consented to cookies
window.cg__addCustomFontForCookieConsent = () => {

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
window.cg__hasConsentedToCookies = () => {
    return localStorage.getItem(LOCAL_STORAGE_COOKIE_NAME) === 'true';
}

// Set consent for cookies into localStorage
window.cg__setCookieConsentToLocalStorage = (consent) => {
    localStorage.setItem(LOCAL_STORAGE_COOKIE_NAME, consent ? 'true' : 'false');
}

// Check if the user has sent consented to gtag
window.cg__hasSendConsentedToCookies = () => {
    return localStorage.getItem(LOCAL_STORAGE_COOKIE_SEND) === 'true';
}

// Set consent send for cookies into localStorage
window.cg__setCookieSendConsentToLocalStorage = (consent) => {
    localStorage.setItem(LOCAL_STORAGE_COOKIE_SEND, consent ? 'true' : 'false');
}

window.cg__denyOrAllowAllCookieCategorySession = (action) => {
    // Initialize cookie consent object
    const cookieConsentCategoryTypes = {};

    for (const category in COOKIE_CONSENT_CATEGORY_TYPES) {
        if (Object.hasOwnProperty.call(COOKIE_CONSENT_CATEGORY_TYPES, category)) {
            if (category !== 'neccesary') {
                if (category === 'gc') {
                    let gcObject = cookieConsentCategoryTypes[category] || {};
                    for (const key in COOKIE_CONSENT_CATEGORY_TYPES[category]) {
                        if (Object.hasOwnProperty.call(COOKIE_CONSENT_CATEGORY_TYPES[category], key)) {
                            // Check if the key is not in PARTNER_EXCEPTIONS
                            if (!PARTNER_EXCEPTIONS.includes(key)) {
                                // Set the value based on the action
                                gcObject[key] = action ? "granted" : "denied";
                            } else {
                                gcObject[key] = "granted";
                            }
                        }
                    }
                    cookieConsentCategoryTypes[category] = gcObject;
                } else {
                    cookieConsentCategoryTypes[category] = action;
                }
            }
        }
    }
    window.cg__storeCookieValue(cookieConsentCategoryTypes);
}

window.cg__initiateCookieCategorySession = () => {
    // Initialize cookie consent object
    if (document.cookie.indexOf(COOKIE_NAME) === -1) {
        window.cg__storeCookieValue(COOKIE_CONSENT_CATEGORY_TYPES);
    } else {
        //send gtag
        //if (!hasSendConsentedToCookies()) {
        //setCookieSendConsentToLocalStorage(true)
        setTimeout(() => {
            window.cg__send_gtmConsentDataObject();
        }, 500); // Adjust the delay as needed
        //}

    }
}

window.cg__checkCookieCategorySession = () => {
    // Retrieve the value of the cookieConsent cookie
    const cookieConsentCookie = document.cookie.split(';').find(cookie => cookie.trim().startsWith(COOKIE_NAME + '='));
    // If the cookie exists
    if (cookieConsentCookie) {
        const cookieConsentString = cookieConsentCookie.split('=')[1];
        const cookieConsentObject = JSON.parse(cookieConsentString);
        // Loop through each checkbox input and set its checked property based on the cookieConsentObject
        const checkboxes = document.querySelectorAll('.___cookieConsent__Toggle input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            const cookieCategory = checkbox.name.replace('___cookieConsent__', '').toLowerCase();
            checkbox.checked = cookieConsentObject[cookieCategory];
        });
    }
}

window.cg__setCookieCategoryConsent = (category, overWriteAction = null) => {
    // Retrieve the value of the cookieConsent cookie
    const cookieConsentCookie = document.cookie.split(';').find(cookie => cookie.trim().startsWith(COOKIE_NAME + '='));

    // If the cookie exists
    if (cookieConsentCookie) {
        const cookieConsentString = cookieConsentCookie.split('=')[1];
        let cookieConsentObject = JSON.parse(cookieConsentString);

        // Update the corresponding property in the cookieConsentObject
        let currentAction = !cookieConsentObject[category];
        if (overWriteAction !== null) {
            currentAction = overWriteAction;
        }
        cookieConsentObject[category] = currentAction;

        // Set consent for 'gc' category
        window.cg__setGCConsent(category, currentAction, cookieConsentObject);
        console.log(cookieConsentObject);

        window.cg__storeCookieValue(cookieConsentObject);

        // Update the checked property of the corresponding checkbox input
        const checkbox = document.querySelector(`input[name="${category}"]`);
        if (checkbox) {
            checkbox.checked = cookieConsentObject[category];
        }
    }
}

window.cg__storeCookieValue = (updatedObject) => {
    // Serialize the updated object back to a string
    const updatedCookieConsentString = JSON.stringify(updatedObject);
    const expirationDate = new Date();
    expirationDate.setFullYear(expirationDate.getFullYear() + 1);

    // Update the cookie with the updated string
    document.cookie = `${COOKIE_NAME}=${updatedCookieConsentString}; expires=${expirationDate.toUTCString()}; path=/`;
}

window.cg__setGCConsent = (category, action, cookieConsentObject) => {
    console.log('enters here setGCConsent category:' + category);
    console.log('enters here setGCConsent action:' + action);
    const gcCategory = 'gc';
    let gcObject = cookieConsentObject[gcCategory] || {};

    if (COOKIE_CONSENT_CATEGORY_SIMPLE_TYPE && category !== 'necessary') {
        for (const key in gcObject) {
            if (Object.hasOwnProperty.call(gcObject, key)) {
                if (!PARTNER_EXCEPTIONS.includes(key)) {
                    gcObject[key] = action ? "granted" : "denied";
                } else {
                    gcObject[key] = "granted";
                }
            }
        }
    } else {
        if (category === 'preferences') {
            console.log('should enter here if ' + category);
            gcObject = window.cg__updateCookieConsent(['ad_user_data', 'ad_personalization'], action, cookieConsentObject);
        }
        if (category === 'statistics') {
            console.log('should enter here if ' + category);
            gcObject = window.cg__updateCookieConsent(['analytics_storage'], action, cookieConsentObject);
        }
        if (category === 'marketing') {
            console.log('should enter here if ' + category);
            gcObject = window.cg__updateCookieConsent(['ad_storage'], action, cookieConsentObject);
        }
    }
    console.log(gcObject);

    cookieConsentObject[gcCategory] = gcObject;

    return cookieConsentObject;
}

window.cg__updateCookieConsent = (keysToUpdate, action, cookieConsentObject) => {
    const gcCategory = 'gc';
    let gcObject = cookieConsentObject[gcCategory] || {};

    for (const key in cookieConsentObject[gcCategory]) {
        if (Object.hasOwnProperty.call(cookieConsentObject[gcCategory], key) && keysToUpdate.includes(key)) {
            gcObject[key] = action ? "granted" : "denied";
        }
    }
    return gcObject;
}


window.cg__create_gtmConsentDataObject = (gcObject, gtagType) => {
    if (gtagType) {
        return {
            'analytics': gcObject?.analytics_storage,
            'analytics_storage': gcObject?.analytics_storage,
            'ad_storage': gcObject?.ad_storage,
            'ad_user_data': gcObject?.ad_user_data,
            'ad_personalization': gcObject?.ad_personalization
        };
    } else {
        return {
            'analytics': {
                'storage': gcObject?.analytics_storage  // Extract value from CMP
            },
            'ads': {
                'storage': gcObject?.ad_storage,  // Extract value from CMP
                'user_data': gcObject?.ad_user_data,  // Extract value from CMP (if applicable)
                'personalization': gcObject?.ad_personalization  // Extract value from CMP (if applicable)
            }
        };
    }
}

window.cg__send_gtmConsentDataObject = () => {
    // Retrieve the value of the cookieConsent cookie
    const cookieConsentCookie = document.cookie.split(';').find(cookie => cookie.trim().startsWith(COOKIE_NAME + '='));
    let returnValue;

    if (cookieConsentCookie) {
        const cookieConsentString = cookieConsentCookie.split('=')[1];
        const cookieConsentObject = JSON.parse(cookieConsentString);
        if (cookieConsentObject.gc) {
            //const gtmConsent = create_gtmConsentDataObject(cookieConsentObject.gc);
            //console.log(gtmConsent);
            if ((document.querySelector('script[src*="gtm.js"]') || document.querySelector('script[src*="https://www.googletagmanager.com/gtag/js"]')) && window?.dataLayer !== undefined) {
                // // Option 1: Update consent using dataLayer (recommended)
                // returnValue = dataLayer.push({
                //     'event': 'gtm.js',
                //     'gtm.uniqueEventId': '{{Unique Event ID}}',
                //     'gtm.triggers': '{{Trigger Firing Events}}',
                //     'gtm.consent': gtmConsent
                // });
                // console.log('window.dataLayer in send_gtmConsentDataObject: AFTER PUSH');
                // console.log(window.dataLayer);
                // Option 2: Update consent using gtag (optional)
                const gtmConsent = create_gtmConsentDataObject(cookieConsentObject.gc, true);
                returnValue = gtag('consent', 'update', gtmConsent);
            } else {
                returnValue = 'NO GTM!';
                console.warn('GTM library is not loaded!');
            }
            return returnValue;
        }
    }
}

window.cg__displayCookieConsentButton = () => {
    window.cg__getMaxZIndex = () => {
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

    const CONSENT_MODAL_Z_INDEX = window.cg__getMaxZIndex();

    // Dynamically create style for root variables
    const style = document.createElement('style');
    style.textContent = `
        :root {
            --WIDGET_MAIN_COLOR: ${WIDGET_MAIN_COLOR}; /* Replace with your actual color value */
            --WIDGET_SECOND_COLOR: ${WIDGET_SECOND_COLOR}; /* Replace with your actual color value */
            --CONSENT_MODAL_Z_INDEX: ${CONSENT_MODAL_Z_INDEX};  /* Ensure the backdrop is behind the modal */
        }
    `;
    // Append style element to the document head
    document.head.appendChild(style);

    // Create cookie consent button
    const cookieConsentButton = document.createElement('div');
    cookieConsentButton.innerHTML = `
        <div id="___cookieButtonConsent" onclick="window.cg__showCookieConsentModal()"></div>
    `;
    document.body.appendChild(cookieConsentButton);
    document.querySelector('div#___cookieButtonConsent').insertAdjacentHTML('beforeend', svgCCookie);
}

// Function to display cookie consent modal
window.cg__displayCookieConsentModal = () => {

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
                <div class="___cookieConsent__toggleHolder" onclick="window.cg__setCookieCategoryConsent('preferences')"><div class="___cookieConsent__toggleInner"></div></div>
            </div>
        </label>
        <div class="___cookieConsent__ToggleDivider"></div>
        <label for="___cookieConsent__Statistics" class="___cookieConsent__ToggleLabel">
            <span>Statistici</span>
            <div class="___cookieConsent__Toggle">
                <input type="checkbox" id="___cookieConsent__Statistics" name="___cookieConsent__Statistics" value="statistics">
                <div class="___cookieConsent__toggleHolder" onclick="window.cg__setCookieCategoryConsent('statistics')"><div class="___cookieConsent__toggleInner"></div></div>
            </div>
        </label>
        <div class="___cookieConsent__ToggleDivider"></div>
        <label for="___cookieConsent__Marketing" class="___cookieConsent__ToggleLabel">
            <span>Marketing</span>
            <div class="___cookieConsent__Toggle">
                <input type="checkbox" id="___cookieConsent__Marketing" name="___cookieConsent__Marketing" value="marketing">
                <div class="___cookieConsent__toggleHolder" onclick="window.cg__setCookieCategoryConsent('marketing')"><div class="___cookieConsent__toggleInner"></div></div>
            </div>
        </label>
    </div>`;
    const EXTENDED_LIST_BUTTONS = `
        <button class="___cookieConsent__consentButton ___cookieConsent__borderOnly" onClick="window.cg__allowAllCookies()">Accepta toate</button>
        <button class="___cookieConsent__consentButton ___cookieConsent__borderOnly" onClick="window.cg__denyAllCookies()">Respinge toate</button>
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
                <div class="___cookieConsent__toggleHolder" onclick="window.cg__setCookieCategoryConsent('optional')"><div class="___cookieConsent__toggleInner"></div></div>
            </div>
        </label>
    </div>`;

    const SIMPLE_LIST_BUTTONS = `<button class="___cookieConsent__consentButton ___cookieConsent__borderOnly" onclick="window.cg__denyAllCookies()">Respinge toate</button>`;

    // Create cookie consent modal
    const modal = document.createElement('div');
    modal.innerHTML = `
        <div id="___cookieConsent__ModalConsent">
            <div id="___cookieConsent__ModalWrapper">
            <h2 id="___cookieConsent__Title">Folosim cookies</h2>
            <div id="___cookieConsent__TabButtons">
                <div class="___cookieConsent__Tab" onclick="window.cg__showTab('___cookieConsent__Consent')" id="___cookieConsent__ConsentTabButton">${consimtamantText?.title}</div>
                <div class="___cookieConsent__Tab" onclick="window.cg__showTab('___cookieConsent__Details')" id="___cookieConsent__DetailsTabButton">Detalii</div>
                <div class="___cookieConsent__Tab" onclick="window.cg__showTab('___cookieConsent__About')" id="___cookieConsent__AboutTabButton">${despreText?.title}</div>
            </div>
            <div id="___cookieConsent__TabContent">
                <div id="___cookieConsent__ConsentTab">
                     ${consimtamantText?.content.map(paragraph => `<p>${paragraph}</p>`).join('')}
                    <p>Selecteaza din lista de mai jos:</p>
                    ${COOKIE_CONSENT_CATEGORY_SIMPLE_TYPE ? SIMPLE_LIST : EXTENDED_LIST}
                </div>
                <div id="___cookieConsent__DetailsTab" style="display:none;">
                    <p>Detalii despre cookiurile folosite...</p>
                </div>
                <div id="___cookieConsent__AboutTab" style="display:none;">
                    <div style="display: block">
                    ${despreText?.content.map(paragraph => `<p>${paragraph}</p>`).join('')}
                    </div>
                </div>
            </div>
            <div id="___cookieConsent__footerButtons">
                ${COOKIE_CONSENT_CATEGORY_SIMPLE_TYPE ? SIMPLE_LIST_BUTTONS : EXTENDED_LIST_BUTTONS}
                <button class="___cookieConsent__consentButton" onclick="window.cg__acceptSelectionCookies()">Accepta selecția</button>
    </div>
        </div>
      </div>
    `;
    document.body.appendChild(modal);
    //document.querySelector('h2#___cookieConsent__Title').insertAdjacentHTML('beforeend', svgCCookie);
    // Open the Consent tab by default
    window.cg__showTab('___cookieConsent__Consent');
}

// Function to close cookie consent modal
window.cg__closeCookieModal = () => {
    document.getElementById('___cookieConsent__ModalConsent').remove();
    document.getElementById('___cookieConsentBackdrop').remove();
}

// Function to show a specific tab in the cookie consent modal
window.cg__showTab = (tabName) => {
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
        window.cg__displayCookieDetails();
    }
}


// Function to read current cookies and display them in the Details tab
window.cg__displayCookieDetails = () => {
    let cookies = document.cookie.split(';'); // Split cookies into an array
    //console.log(cookies);

    let cookieDetailsHtml = ''; // Variable to store the HTML for the cookie details

    // Loop through each cookie
    cookies.forEach((cookie) => {
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
        } else {
            // Add logic to determine other types based on cookie name or value if needed
            type = 'optional';
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
window.cg__acceptSelectionCookies = () => {
    window.cg__setCookieConsentToLocalStorage(true);
    window.cg__send_gtmConsentDataObject();
    window.cg__closeCookieModal();
}

// Function to deny all cookies
window.cg__denyAllCookies = () => {
    window.cg__setCookieConsentToLocalStorage(false);
    window.cg__setCookieSendConsentToLocalStorage(false);
    window.cg__denyOrAllowAllCookieCategorySession(false);
    window.cg__send_gtmConsentDataObject();
    window.cg__closeCookieModal();
}

// Function to allow all cookies
window.cg__allowAllCookies = () => {
    window.cg__setCookieConsentToLocalStorage(true);
    window.cg__denyOrAllowAllCookieCategorySession(true);
    window.cg__send_gtmConsentDataObject();
    window.cg__closeCookieModal();
}

// Function to show modal from button
window.cg__showCookieConsentModal = () => {
    window.cg__addCustomFontForCookieConsent();
    window.cg__displayCookieConsentModal();
    setTimeout(() => {
        window.cg__checkCookieCategorySession();
    }, 500); // Adjust the delay as needed
}

// Check if user has already consented to cookies
window.onload = () => {
    window.cg__displayCookieConsentButton();
    if (!window.cg__hasConsentedToCookies()) {
        window.cg__displayCookieConsentModal();
        window.cg__addCustomFontForCookieConsent();
    }
    window.cg__initiateCookieCategorySession();
    setTimeout(() => {
        window.cg__checkCookieCategorySession();
    }, 500); // Adjust the delay as needed
};
