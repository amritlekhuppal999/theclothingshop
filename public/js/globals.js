

// const MAIN_URL = window.location.protocol + '//' + window.location.host + ':8000';
const MAIN_URL = window.location.protocol + '//' + window.location.host;
const HOME_URL = MAIN_URL;
const ADMIN_URL = MAIN_URL+"/admin";

const LOADER_SMALL = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
const LOADER_MEDIUM = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
const LOADER_BIG = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

const EXCLAMATION_DANGER = '<i class="fas fa-exclamation-triangle" style="color:#dc3545;"></i>';

const CHECK_SUCCESS = '<i class="fas fa-check"></i>';

// Get the current URL of the page along with query parameters
const FULL_URL = window.location.href; 

// Get the hostname of the current URL
const HOSTNAME = window.location.hostname; 

// Get the pathname of the current URL
const PATHNAME = window.location.pathname; 

// Get the protocol of the current URL (e.g., "http:", "https:")
const PROTOCOL = window.location.protocol; 

// Get the port number of the current URL
const PORT = window.location.port; 


const CURRENT_URL = `${PROTOCOL}//${HOSTNAME}:${PORT}${PATHNAME}`; 

const PUBLIC_PATH = document.querySelector('meta[name="public-path"]').getAttribute('content');


// ERROR CODES
    const REQUEST_SUCCESSFUL = 200;     // Request successfully received
    const VALIDATION_ERROR = 422;       // Data sent do not obey the rules. (Form Validation, etc)
    const NOT_FOUND_ERROR = 404;        // Link/URL/URI/ROUTE NOT FOUND
    const BAD_REQUEST_ERROR = 400;      // User Sent incorrect/corrupt data
    const INTERNAL_SERVER_ERROR = 500;  // Dev/System/Backend messed up

// ERROR CODES END


// FUNCTION TO REMOVE WHITESPACES FROM a STRING
    function remove_whitespace(str){
        return str.trim().replace(/\s+/g, " ");
    }
//FUNCTION TO REMOVE WHITESPACES FROM a STRING END 

// FUNCTION TO GENERATE SLUG
    function generate_slug(str){
        //str.trim().replace(/\s+/g, " ");
        return remove_whitespace(str.toLowerCase()).replace(/\s+/g, "-");
    }
// FUNCTION TO GENERATE SLUG END

    
// Append query string to URL
    function appendQueryString(url, parameter, value) {
        const urlParts = url.split("?");
        const baseUrl = urlParts[0];
        const existingParams = new URLSearchParams(urlParts[1] || "");

        console.log(url, urlParts)
    
        if (existingParams.has(parameter)) {
            existingParams.set(parameter, value);
        } else {
            existingParams.append(parameter, value);
        }
    
        return baseUrl + (existingParams.toString() ? "?" + existingParams.toString() : "");
    }

    function appendQueryString_OLD(url, parameter, value) {
        const hasQueryString = url.indexOf("?") !== -1;
    
        const separator = hasQueryString ? "&" : "?";
        return url + separator + parameter + "=" + value;
    }
// Append query string to URL END

// Function to set option of a select element as selected
    function set_select_value(selector){
                    
        let element;
        if(selector.charAt(0) === "."){
            selector = selector.replace(/^\./, ''); 
            // alert(element.dataset.value);
            element = document.getElementsByClassName(selector)[0];
        }
        else if(selector.charAt(0) === "#"){
            selector =selector.replace(/^\#/, '');
            element = document.getElementById(selector);
        }
        
        //let element = document.getElementById(selector);
        alert(element.dataset.value);

        let optionList = element.options;
        for(let i=0; i<optionList.length; i++){
            if(optionList[i].value == element.dataset.value){
                optionList[i].selected = true;
                break;
            }
        }
    }
// Function to set option of a select element as selected END



// Example of an FETCH GET FUNCTION 
    async function FETCH_GET_DATA(subject_id){
        const request_data = {
            subject_id: subject_id
        };
        const params = new URLSearchParams(request_data);
        
        const request_options = {
            method: 'GET',
            // headers: {},
            // body: JSON.stringify(request_data)
        };

        let url = '/admin/get-category-list?'+params;

        try{
            let response = await fetch(url, request_options);
            // console.log(response);
            let response_data = await response.json();

            return response_data;
        }
        catch(error){
            console.error('Error:', error);
        }
    }
// Example of an FETCH GET FUNCTION END

// Example of FETCH POST FUNCTION
    async function FETCH_POST_DATA(){
        let form_data = {
            subject: subject,
            question_type: question_type,
            question: question,
            answer_field: answer_field,
            option_list: option_list_arr,
            correct_option: correct_option,
            notes: notes,
            topic: topic,
            chapter: chapter,
            question_images: image_arr,
            csrf_token: csrf_token
        };

        // console.log(form_data);

        const request_options = {
            method: 'POST',
            // headers: {},
            body: JSON.stringify(form_data)
        };

        let url = home_url+'add-questions';

        try{
            let response = await fetch(url, request_options);
            // console.log(response);
            let response_data = await response.json();

            // console.log('Response:', response_data);
            if(response_data.error_code){
                toastr.error(response_data.message);
                submit_btn.innerHTML = submit_btn_cont;
                submit_btn.disabled = false;
            }
            else {
                toastr.success(response_data.message);
                submit_btn.innerHTML = submit_btn_cont;
                submit_btn.disabled = false;
                resetForm();
                // submit_btn.remove();
                // setTimeout(() => {
                //     // location.reload()
                //     window.location.href = home_url;
                // }, 1000);
            }
        }
        catch(error){
            console.error('Error:', error);
        }
    }
// Example of FETCH POST FUNCTION END

// A function to run loading animation anywhere
    function LOADING_ANIMATION(selector='animate-loading-text', action=""){
        let LOADER_TEXT_ELE = document.getElementsByClassName(selector);
        let loaderTextArray = Array.from(LOADER_TEXT_ELE);
        loaderTextArray.forEach((element)=>{
            new TextAnimator(element, 100);
        });
    }
// A function to run loading animation anywhere END

// Set it to false so we can customise toastr methods
    //toastr.options.escapeHtml = false;
// Set it to false so we can customise toastr methods END


// Convert data object to query parameter
    /*
    const request_data = {
        category_id: category_id,
        sub_category_id: sub_category_id,
    };
    const params = new URLSearchParams();
    
    for (const key in request_data) {
        if (Object.hasOwnProperty.call(request_data, key)) {
            const value = request_data[key];
            // You might want to skip null or undefined values if they shouldn't be in the URL
            if (value !== null && typeof value !== 'undefined') {
                params.append(key, value);
            }
        }
    }
    const queryString = params.toString();
    console.log(queryString);
    */
// Convert data object to query parameter END


// SEARCH BOX
/* 
    DEVELOPER'S NOTE
    so here we are trying to create a live search for the subjects, now we want to prevent sending
    fetch requests after every key pressed, so we add a timeout, but we know that it only suspends the
    current operation which means is if user presses multiple key strokes, the strokes will be registered 
    and after the given delay all the requests will be sent. SO to avoid that from happening we need to 
    reset the timer upon every click and thats where clearTImeout comes in.
    
    In the MDN docs we find that setTimeout returns a timeoutID which can be used to clear current 
    timeout operation hence resetting our clock...
*/
/*
document.getElementById("search-keyword").addEventListener('keyup', event=>{
    let search_input = event.target;
    // console.log(search_input.value);
    result_options.search_keyword = search_input.value.replace(/\s/g, " ");
    // result_options.subject_id = document.getElementById('subject_id').value;

    if(result_options.search_keyword.length){
        document.getElementById("chapter-table-body").innerHTML = `<tr><td colspan="3">Loading...</td></tr>`;

        if(timeoutID)
            clearTimeout(timeoutID);

        timeoutID = setTimeout(() => {
            load_chapters(result_options);
        }, 700);
    }

    // 1000ms = 1sec

});
*/