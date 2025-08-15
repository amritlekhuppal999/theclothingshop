

window.MyApp = window.MyApp || {};

if (!MyApp.initDone){

    // const MAIN_URL = window.location.protocol + '//' + window.location.host + ':8000';
    MyApp.MAIN_URL = window.location.protocol + '//' + window.location.host;
    MyApp.HOME_URL = MyApp.MAIN_URL;
    MyApp.ADMIN_URL = MyApp.MAIN_URL+"/admin";
    
    MyApp.LOADER_SMALL = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
    MyApp.LOADER_MEDIUM = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
    MyApp.LOADER_BIG = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
    
    MyApp.EXCLAMATION_DANGER = '<i class="fas fa-exclamation-triangle" style="color:#dc3545;"></i>';
    
    MyApp.CHECK_SUCCESS = '<i class="fas fa-check"></i>';
    
    // Get the current URL of the page along with query parameters
    MyApp.FULL_URL = window.location.href; 
    
    // Get the hostname of the current URL
    MyApp.HOSTNAME = window.location.hostname; 
    
    // Get the pathname of the current URL
    MyApp.PATHNAME = window.location.pathname; 
    
    // Get the protocol of the current URL (e.g., "http:", "https:")
    MyApp.PROTOCOL = window.location.protocol; 
    
    // Get the port number of the current URL
    MyApp.PORT = window.location.port; 
    
    
    MyApp.CURRENT_URL = `${MyApp.PROTOCOL}//${MyApp.HOSTNAME}:${MyApp.PORT}${MyApp.PATHNAME}`; 
    
    
    MyApp.PUBLIC_PATH = null;
    if(document.querySelector('meta[name="public-path"]')){
        MyApp.PUBLIC_PATH = document.querySelector('meta[name="public-path"]').getAttribute('content');
    }
    
    
    // ERROR CODES
        MyApp.REQUEST_SUCCESSFUL = 200;     // Request successfully received
        MyApp.REQUESTED_DATA_UNAVAILABLE = 204;     // The server successfully processed the request, and is not returning any content.
        MyApp.VALIDATION_ERROR = 422;       // Data sent do not obey the rules. (Form Validation, etc)
        MyApp.NOT_FOUND_ERROR = 404;        // Link/URL/URI/ROUTE NOT FOUND
        MyApp.BAD_REQUEST_ERROR = 400;      // User Sent incorrect/corrupt data
        MyApp.UNAUTHORISED_ACCESS = 401;      // Unauthorised access
        MyApp.PAGE_EXPIRED = 419;           // PAGE EXPIRED (maybe a csrf mismatch )
        MyApp.INTERNAL_SERVER_ERROR = 500;  // Dev/System/Backend messed up
    
    // ERROR CODES END
    
    
    // FUNCTION TO REMOVE WHITESPACES FROM a STRING
        MyApp.remove_whitespace = function (str){
            return str.trim().replace(/\s+/g, " ");
        }
    //FUNCTION TO REMOVE WHITESPACES FROM a STRING END 
    
    // FUNCTION TO GENERATE SLUG
        MyApp.generate_slug = function (str) {
            // 1. Convert to lowercase
            let cleanedStr = str.toLowerCase();

            // 2. Replace anything that's NOT a letter, number, or apostrophe with a space
            //    [^a-z0-9'] matches any character that is NOT:
            //    a-z: lowercase letters
            //    0-9: numbers
            //    ': apostrophe
            //    The 'g' flag ensures all occurrences are replaced.
            // cleanedStr = cleanedStr.replace(/[^a-z0-9']/g, ' ');
            cleanedStr = cleanedStr.replace(/[^a-z0-9]/g, ' ');

            // 3. Remove leading/trailing whitespace (using your existing function)
            cleanedStr = MyApp.remove_whitespace(cleanedStr);

            // 4. Replace one or more spaces with a single hyphen
            return cleanedStr.replace(/\s+/g, "-");

            //return MyApp.remove_whitespace(str.toLowerCase()).replace(/\s+/g, "-");   //OLD FUNCTION
        };
    // FUNCTION TO GENERATE SLUG END
    
        
    // Append query string to URL
        MyApp.appendQueryString = function (url, parameter, value) {
            const urlParts = url.split("?");
            const baseUrl = urlParts[0].replace("#", '');
            const existingParams = new URLSearchParams(urlParts[1] || "");
    
            // console.log(existingParams.toString());
            // console.log(url, urlParts);
        
            if (existingParams.has(parameter)) {
                existingParams.set(parameter, value);
            } else {
                existingParams.append(parameter, value);
            }
            
            // baseUrl = baseUrl.replace("#", '');
            return baseUrl + (existingParams.toString() ? "?" + existingParams.toString() : "");
        }
    
        MyApp.appendQueryString_OLD = function (url, parameter, value) {
            const hasQueryString = url.indexOf("?") !== -1;
        
            const separator = hasQueryString ? "&" : "?";
            return url + separator + parameter + "=" + value;
        }
    // Append query string to URL END
    
    // Function to set option of a select element as selected
        MyApp.set_select_value = function (selector){
                        
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
    
    
    // delay any action by given amount of time
        MyApp.debounce = function (actualFunctionToDo, delayTimeMs) {
            let timerId; // This variable will hold our timer's ID. It starts empty.
    
            // This is the "wrapped" function that we will actually call in our event listener.
            return function() {
                clearTimeout(timerId);
    
                timerId = setTimeout(() => {
                    actualFunctionToDo(); // Execute the original function
                }, delayTimeMs);
            };
        }
    // delay any action by given amount of time END
    
    
    // Example of an FETCH GET FUNCTION 
        MyApp.FETCH_GET_DATA = async function (subject_id){
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
            catch(error){   // Handles Network Errors
                console.error('Error:', error);
            }
        }
    // Example of an FETCH GET FUNCTION END
    
    // Example of FETCH POST FUNCTION
        MyApp.FETCH_POST_DATA = async function (){
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
            catch(error){   // Handles Network Errors
                console.error('Error:', error);
            }
        }
    // Example of FETCH POST FUNCTION END
    
    // A function to run loading animation anywhere
        MyApp.LOADING_ANIMATION = function (selector='animate-loading-text', action=""){
            let LOADER_TEXT_ELE = document.getElementsByClassName(selector);
            let loaderTextArray = Array.from(LOADER_TEXT_ELE);
            loaderTextArray.forEach((element)=>{
                new TextAnimator(element, 100);
            });
        }
    // A function to run loading animation anywhere END


    // Check for empty objects 
        MyApp.isEmptyObject = function (obj){
            // Check if the object is null or undefined first to prevent errors
            if(obj === null || typeof obj === 'undefined'){
                return true;    // Consider null or undefined as "empty" in this context
            }

            // Check if the object has any enumerable string-keyed properties
            return Object.keys(obj).length === 0;
        }
    // Check for empty objects  END


    // COPY to CLIPBOARD
        MyApp.copyTextToClipboard = async function (text) {
            try {
                await navigator.clipboard.writeText(text);
                console.log('Text copied to clipboard successfully!');
                toastr.success("Text Copied");
            } catch (err) {
                console.error('Failed to copy text: ', err);
                // Fallback for older browsers or if permission is denied
                //fallbackCopyTextToClipboard(text);
            }
        }
    // COPY to CLIPBOARD END


    // Limit String to a given ch length
        MyApp.limitString = function (str, maxLength) {
            if (str.length <= maxLength || maxLength == 0) {
                return str;
            }
            // console.log(str.length, maxLength);
            return str.substring(0, maxLength) + "...";
        }
    // Limit String END


    
    // Set it to false so we can customise toastr methods
        //toastr.options.escapeHtml = false;
    // Set it to false so we can customise toastr methods END

}



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