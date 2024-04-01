(()=>{const COOKIE_NAME="cookieConsentGlobalHolder",COOKIE_CONSENT_GOOGLE_PARTNER={ad_storage:"denied",ad_user_data:"denied",ad_personalization:"denied",analytics_storage:"denied",functionality_storage:"granted",personalization_storage:"granted"},PARTNER_EXCEPTIONS=["functionality_storage","personalization_storage"],COOKIE_CONSENT_CATEGORY_TYPES={necessary:!0,preferences:false,statistics:false,marketing:false,gc:COOKIE_CONSENT_GOOGLE_PARTNER},svgCCookie=`<svg id="${COOKIE_NAME}-svg1" fill="#000" height="30px" width="30px" version="1.1"\n                            xmlns="http://www.w3.org/2000/svg"\n                            viewBox="0 0 299.049 299.049" xml:space="preserve">\n                                    <g>\n                                        <g>\n                                            <g>\n                                                <path d="M289.181,206.929c-13.5-12.186-18.511-31.366-12.453-48.699c1.453-4.159-0.94-8.686-5.203-9.82\n                                                c-27.77-7.387-41.757-38.568-28.893-64.201c2.254-4.492-0.419-9.898-5.348-10.837\n                                                c-26.521-5.069-42.914-32.288-34.734-58.251\n                                                c1.284-4.074-1.059-8.414-5.178-9.57C184.243,1.867,170.626,0,156.893,0C74.445,0,7.368,67.076,7.368,149.524\n                                                s67.076,149.524,149.524,149.524c57.835,0,109.142-33.056,133.998-83.129C292.4,212.879,291.701,209.204,289.181,206.929z\n                                                M156.893,283.899c-74.095,0-134.374-60.281-134.374-134.374S82.799,15.15,156.893,15.15c9.897,0,19.726,1.078,29.311,3.21\n                                                c-5.123,29.433,11.948,57.781,39.41,67.502c-9.727,29.867,5.251,62.735,34.745,74.752c-4.104,19.27,1.49,39.104,14.46,53.365\n                                                C251.758,256.098,207.229,283.899,156.893,283.899z"/>\n                                                <path d="M76.388,154.997c-13.068,0-23.7,10.631-23.7,23.701c0,13.067,10.631,23.7,23.7,23.7c13.067,0,23.7-10.631,23.7-23.7\n                                                C100.087,165.628,89.456,154.997,76.388,154.997z M76.388,187.247c-4.715,0-8.55-3.835-8.55-8.55s3.835-8.551,8.55-8.551\n                                                c4.714,0,8.55,3.836,8.55,8.551S81.102,187.247,76.388,187.247z"/>\n                                                <path d="M173.224,90.655c0-14.9-12.121-27.021-27.02-27.021s-27.021,12.121-27.021,27.021c0,14.898,12.121,27.02,27.021,27.02\n                                                C161.104,117.674,173.224,105.553,173.224,90.655z M134.334,90.655c0-6.545,5.325-11.871,11.871-11.871\n                                                c6.546,0,11.87,5.325,11.87,11.871s-5.325,11.87-11.87,11.87S134.334,97.199,134.334,90.655z"/>\n                                                <path d="M169.638,187.247c-19.634,0-35.609,15.974-35.609,35.61c0,19.635,15.974,35.61,35.609,35.61\n                                                c19.635,0,35.61-15.974,35.61-35.61C205.247,203.221,189.273,187.247,169.638,187.247z M169.638,243.315\n                                                c-11.281,0-20.458-9.178-20.458-20.46s9.178-20.46,20.458-20.46c11.281,0,20.46,9.178,20.46,20.46\n                                                S180.92,243.315,169.638,243.315z"/>\n                                            </g>\n                                        </g>\n                                    </g>\n                        </svg>`;window.dataLayer=window.dataLayer||[],"function"==typeof window.gtag?window.gtag("consent","default",{analytics:"denied",analytics_storage:"denied",ad_storage:"denied",ad_user_data:"denied",ad_personalization:"denied"}):console.warn("window.gtag is not defined or is not a function."),window.cg__addCustomFontForCookieConsent=()=>{if(!document.getElementById("___cookieConsent_roboto_font_link")){const fontLink=document.createElement("link");fontLink.rel="stylesheet",fontLink.href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap",fontLink.id="___cookieConsent_roboto_font_link",document.head.appendChild(fontLink)}const fontLink=document.createElement("link");fontLink.rel="stylesheet",fontLink.href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap",document.head.appendChild(fontLink)},window.cg__hasConsentedToCookies=()=>"true"===localStorage.getItem("cookieConsentGlobal"),window.cg__setCookieConsentToLocalStorage=consent=>{localStorage.setItem("cookieConsentGlobal",consent?"true":"false")},window.cg__hasSendConsentedToCookies=()=>"true"===localStorage.getItem("cookieConsentGlobal_send"),window.cg__setCookieSendConsentToLocalStorage=consent=>{localStorage.setItem("cookieConsentGlobal_send",consent?"true":"false")},window.cg__denyOrAllowAllCookieCategorySession=action=>{const cookieConsentCategoryTypes={};for(const category in COOKIE_CONSENT_CATEGORY_TYPES)if(Object.hasOwnProperty.call(COOKIE_CONSENT_CATEGORY_TYPES,category)&&"neccesary"!==category)if("gc"===category){let gcObject=cookieConsentCategoryTypes[category]||{};for(const key in COOKIE_CONSENT_CATEGORY_TYPES[category])Object.hasOwnProperty.call(COOKIE_CONSENT_CATEGORY_TYPES[category],key)&&(PARTNER_EXCEPTIONS.includes(key)?gcObject[key]="granted":gcObject[key]=action?"granted":"denied");cookieConsentCategoryTypes[category]=gcObject}else cookieConsentCategoryTypes[category]=action;window.cg__storeCookieValue(cookieConsentCategoryTypes)},window.cg__initiateCookieCategorySession=()=>{-1===document.cookie.indexOf(COOKIE_NAME)?window.cg__storeCookieValue(COOKIE_CONSENT_CATEGORY_TYPES):setTimeout((()=>{window.cg__send_gtmConsentDataObject()}),500)},window.cg__checkCookieCategorySession=()=>{const cookieConsentCookie=document.cookie.split(";").find((cookie=>cookie.trim().startsWith(COOKIE_NAME+"=")));if(cookieConsentCookie){const cookieConsentString=cookieConsentCookie.split("=")[1],cookieConsentObject=JSON.parse(cookieConsentString);document.querySelectorAll('.___cookieConsent__Toggle input[type="checkbox"]').forEach((checkbox=>{const cookieCategory=checkbox.name.replace("___cookieConsent__","").toLowerCase();checkbox.checked=cookieConsentObject[cookieCategory]}))}},window.cg__setCookieCategoryConsent=(category,overWriteAction=null)=>{const cookieConsentCookie=document.cookie.split(";").find((cookie=>cookie.trim().startsWith(COOKIE_NAME+"=")));if(cookieConsentCookie){const cookieConsentString=cookieConsentCookie.split("=")[1];let cookieConsentObject=JSON.parse(cookieConsentString),currentAction=!cookieConsentObject[category];null!==overWriteAction&&(currentAction=overWriteAction),cookieConsentObject[category]=currentAction,window.cg__setGCConsent(category,currentAction,cookieConsentObject),console.log(cookieConsentObject),window.cg__storeCookieValue(cookieConsentObject);const checkbox=document.querySelector(`input[name="${category}"]`);checkbox&&(checkbox.checked=cookieConsentObject[category])}},window.cg__storeCookieValue=updatedObject=>{const updatedCookieConsentString=JSON.stringify(updatedObject),expirationDate=new Date;expirationDate.setFullYear(expirationDate.getFullYear()+1),document.cookie=`${COOKIE_NAME}=${updatedCookieConsentString}; expires=${expirationDate.toUTCString()}; path=/`},window.cg__setGCConsent=(category,action,cookieConsentObject)=>{console.log("enters here setGCConsent category:"+category),console.log("enters here setGCConsent action:"+action);let gcObject=cookieConsentObject.gc||{};return"preferences"===category&&(console.log("should enter here if "+category),gcObject=window.cg__updateCookieConsent(["ad_user_data","ad_personalization"],action,cookieConsentObject)),"statistics"===category&&(console.log("should enter here if "+category),gcObject=window.cg__updateCookieConsent(["analytics_storage"],action,cookieConsentObject)),"marketing"===category&&(console.log("should enter here if "+category),gcObject=window.cg__updateCookieConsent(["ad_storage"],action,cookieConsentObject)),console.log(gcObject),cookieConsentObject.gc=gcObject,cookieConsentObject},window.cg__updateCookieConsent=(keysToUpdate,action,cookieConsentObject)=>{let gcObject=cookieConsentObject.gc||{};for(const key in cookieConsentObject.gc)Object.hasOwnProperty.call(cookieConsentObject.gc,key)&&keysToUpdate.includes(key)&&(gcObject[key]=action?"granted":"denied");return gcObject},window.cg__create_gtmConsentDataObject=(gcObject,gtagType)=>gtagType?{analytics:gcObject?.analytics_storage,analytics_storage:gcObject?.analytics_storage,ad_storage:gcObject?.ad_storage,ad_user_data:gcObject?.ad_user_data,ad_personalization:gcObject?.ad_personalization}:{analytics:{storage:gcObject?.analytics_storage},ads:{storage:gcObject?.ad_storage,user_data:gcObject?.ad_user_data,personalization:gcObject?.ad_personalization}},window.cg__send_gtmConsentDataObject=()=>{const cookieConsentCookie=document.cookie.split(";").find((cookie=>cookie.trim().startsWith(COOKIE_NAME+"=")));let returnValue;if(cookieConsentCookie){const cookieConsentString=cookieConsentCookie.split("=")[1],cookieConsentObject=JSON.parse(cookieConsentString);if(cookieConsentObject.gc){if((document.querySelector('script[src*="gtm.js"]')||document.querySelector('script[src*="https://www.googletagmanager.com/gtag/js"]'))&&void 0!==window?.dataLayer){const gtmConsent=window.cg__create_gtmConsentDataObject(cookieConsentObject.gc,!0);returnValue=gtag("consent","update",gtmConsent)}else returnValue="NO GTM!",console.warn("GTM library is not loaded!");return returnValue}}},window.cg__displayCookieConsentButton=()=>{window.cg__getMaxZIndex=()=>{let maxZIndex=0;return document.querySelectorAll("*").forEach((element=>{const zIndex=parseFloat(window.getComputedStyle(element).zIndex);!isNaN(zIndex)&&zIndex>maxZIndex&&(maxZIndex=zIndex)})),maxZIndex++};const CONSENT_MODAL_Z_INDEX=window.cg__getMaxZIndex(),style=document.createElement("style");style.textContent=`\n        :root {\n            --WIDGET_MAIN_COLOR: #2f9d08; /* Replace with your actual color value */\n            --WIDGET_SECOND_COLOR: #202020; /* Replace with your actual color value */\n            --CONSENT_MODAL_Z_INDEX: ${CONSENT_MODAL_Z_INDEX};  /* Ensure the backdrop is behind the modal */\n        }\n    `,document.head.appendChild(style);const cookieConsentButton=document.createElement("div");cookieConsentButton.innerHTML='\n        <div id="___cookieButtonConsent" onclick="window.cg__showCookieConsentModal()"></div>\n    ',document.body.appendChild(cookieConsentButton),document.querySelector("div#___cookieButtonConsent").insertAdjacentHTML("beforeend",svgCCookie)},window.cg__displayCookieConsentModal=()=>{const backdrop=document.createElement("div");backdrop.setAttribute("id","___cookieConsentBackdrop"),backdrop.classList.add("___cookieConsent__ModalConsentBackdrop"),document.body.appendChild(backdrop);const modal=document.createElement("div");modal.innerHTML=`\n        <div id="___cookieConsent__ModalConsent">\n            <div id="___cookieConsent__ModalWrapper">\n            <h2 id="___cookieConsent__Title">Folosim cookies</h2>\n            <div id="___cookieConsent__TabButtons">\n                <div class="___cookieConsent__Tab" onclick="window.cg__showTab('___cookieConsent__Consent')" id="___cookieConsent__ConsentTabButton">${consimtamantText?.title}</div>\n                <div class="___cookieConsent__Tab" onclick="window.cg__showTab('___cookieConsent__Details')" id="___cookieConsent__DetailsTabButton">Detalii</div>\n                <div class="___cookieConsent__Tab" onclick="window.cg__showTab('___cookieConsent__About')" id="___cookieConsent__AboutTabButton">${despreText?.title}</div>\n            </div>\n            <div id="___cookieConsent__TabContent">\n                <div id="___cookieConsent__ConsentTab">\n                     ${consimtamantText?.content.map((paragraph=>`<p>${paragraph}</p>`)).join("")}\n                    <p>Selecteaza din lista de mai jos:</p>\n                    \n    <div id="___cookieConsent__CategoryButtonList">\n        <label for="___cookieConsent__Necessary" class="___cookieConsent__ToggleLabel">\n            <span>Necesare</span>\n            <div class="___cookieConsent__Toggle">\n                <input type="checkbox" id="___cookieConsent__Necessary" name="___cookieConsent__Necessary" value="necessary" checked disabled>\n                <div class="___cookieConsent__toggleHolder"><div class="___cookieConsent__toggleInner"></div></div>\n            </div>\n        </label>\n        <div class="___cookieConsent__ToggleDivider"></div>\n        <label for="___cookieConsent__Preferences" class="___cookieConsent__ToggleLabel">\n            <span>Preferinte</span>\n            <div class="___cookieConsent__Toggle">\n                <input type="checkbox" id="___cookieConsent__Preferences" name="___cookieConsent__Preferences" value="preferences">\n                <div class="___cookieConsent__toggleHolder" onclick="window.cg__setCookieCategoryConsent('preferences')"><div class="___cookieConsent__toggleInner"></div></div>\n            </div>\n        </label>\n        <div class="___cookieConsent__ToggleDivider"></div>\n        <label for="___cookieConsent__Statistics" class="___cookieConsent__ToggleLabel">\n            <span>Statistici</span>\n            <div class="___cookieConsent__Toggle">\n                <input type="checkbox" id="___cookieConsent__Statistics" name="___cookieConsent__Statistics" value="statistics">\n                <div class="___cookieConsent__toggleHolder" onclick="window.cg__setCookieCategoryConsent('statistics')"><div class="___cookieConsent__toggleInner"></div></div>\n            </div>\n        </label>\n        <div class="___cookieConsent__ToggleDivider"></div>\n        <label for="___cookieConsent__Marketing" class="___cookieConsent__ToggleLabel">\n            <span>Marketing</span>\n            <div class="___cookieConsent__Toggle">\n                <input type="checkbox" id="___cookieConsent__Marketing" name="___cookieConsent__Marketing" value="marketing">\n                <div class="___cookieConsent__toggleHolder" onclick="window.cg__setCookieCategoryConsent('marketing')"><div class="___cookieConsent__toggleInner"></div></div>\n            </div>\n        </label>\n    </div>\n                </div>\n                <div id="___cookieConsent__DetailsTab" style="display:none;">\n                    <p>Detalii despre cookiurile folosite...</p>\n                </div>\n                <div id="___cookieConsent__AboutTab" style="display:none;">\n                    <div style="display: block">\n                    ${despreText?.content.map((paragraph=>`<p>${paragraph}</p>`)).join("")}\n                    </div>\n                </div>\n            </div>\n            <div id="___cookieConsent__footerButtons">\n                \n        <button class="___cookieConsent__consentButton ___cookieConsent__borderOnly" onClick="window.cg__allowAllCookies()">Accepta toate</button>\n        <button class="___cookieConsent__consentButton ___cookieConsent__borderOnly" onClick="window.cg__denyAllCookies()">Respinge toate</button>\n    \n                <button class="___cookieConsent__consentButton" onclick="window.cg__acceptSelectionCookies()">Accepta selecția</button>\n    </div>\n        </div>\n      </div>\n    `,document.body.appendChild(modal),window.cg__showTab("___cookieConsent__Consent")},window.cg__closeCookieModal=()=>{document.getElementById("___cookieConsent__ModalConsent").remove(),document.getElementById("___cookieConsentBackdrop").remove()},window.cg__showTab=tabName=>{document.querySelectorAll(".___cookieConsent__Tab").forEach((tabButton=>{tabButton.classList.remove("active")}));document.getElementById(tabName+"TabButton").classList.add("active");document.querySelectorAll("#___cookieConsent__TabContent > div").forEach((tab=>{tab.style.display="none"})),document.getElementById(tabName+"Tab").style.display="block","___cookieConsent__Details"===tabName&&window.cg__displayCookieDetails()},window.cg__displayCookieDetails=()=>{let cookies=document.cookie.split(";"),cookieDetailsHtml="";cookies.forEach((cookie=>{let parts=(cookie=cookie.trim()).split("="),name=parts[0].trim(),value=parts.slice(1).join("=").trim(),type="";type="cookieConsentGlobalHolder"===name||"PHPSESSID"===name?"necessary":"optional",cookieDetailsHtml+="<b>Cookie Name:</b> "+name+"<br>",cookieDetailsHtml+="<b>Value:</b> "+value+"<br>",cookieDetailsHtml+="<b>Type:</b> "+type+"<br><br>"})),document.getElementById("___cookieConsent__DetailsTab").innerHTML='<div id="___cookieConsent__Wrapper">'+cookieDetailsHtml+"</div>"},window.cg__acceptSelectionCookies=()=>{window.cg__setCookieConsentToLocalStorage(!0),window.cg__send_gtmConsentDataObject(),window.cg__closeCookieModal()},window.cg__denyAllCookies=()=>{window.cg__setCookieConsentToLocalStorage(!1),window.cg__setCookieSendConsentToLocalStorage(!1),window.cg__denyOrAllowAllCookieCategorySession(!1),window.cg__send_gtmConsentDataObject(),window.cg__closeCookieModal()},window.cg__allowAllCookies=()=>{window.cg__setCookieConsentToLocalStorage(!0),window.cg__denyOrAllowAllCookieCategorySession(!0),window.cg__send_gtmConsentDataObject(),window.cg__closeCookieModal()},window.cg__showCookieConsentModal=()=>{window.cg__addCustomFontForCookieConsent(),window.cg__displayCookieConsentModal(),setTimeout((()=>{window.cg__checkCookieCategorySession()}),500)},window.onload=()=>{window.cg__displayCookieConsentButton(),window.cg__hasConsentedToCookies()||(window.cg__displayCookieConsentModal(),window.cg__addCustomFontForCookieConsent()),window.cg__initiateCookieCategorySession(),setTimeout((()=>{window.cg__checkCookieCategorySession()}),500)}})();