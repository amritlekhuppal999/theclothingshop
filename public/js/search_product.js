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

    var product_search_timeoutID = null;

    let result_options = {
        limit: 10,
        start: 0,
        search_keyword: ''
    };

    const PRODUCT_SEARCH_BAR = document.getElementById("product-search-bar");
    const PRODUCT_RESULT_SECTION = document.getElementById("load-product-list");

    PRODUCT_SEARCH_BAR.addEventListener('keyup', event=>{
        let search_input = event.target;
        // console.log(search_input.value);
        result_options.search_keyword = search_input.value.replace(/\s/g, " ");
        // result_options.subject_id = document.getElementById('subject_id').value;

        if(result_options.search_keyword.length){
            PRODUCT_RESULT_SECTION.innerHTML = `<tr><td colspan="8">Loading...</td></tr>`;

            if(product_search_timeoutID)
                clearTimeout(product_search_timeoutID);

            product_search_timeoutID = setTimeout(() => {
                load_products(result_options);
            }, 700);
        }

        // 1000ms = 1sec

    });


    async function load_products(result_options){
        const params = new URLSearchParams(result_options);

        PRODUCT_RESULT_SECTION.innerHTML = `<tr>
            <td colspan="8">Loading...</td>
        </tr>`;
        
        const request_options = {
            method: 'GET',
            // headers: {},
            // body: JSON.stringify(request_data)
        };

        let url = '/admin/search-product?'+params;

        try {
            const response = await fetch(url, request_options);
            const html = await response.text();
            
            PRODUCT_RESULT_SECTION.innerHTML = html;
        } 
        catch (error) {
            console.error("Error loading search bar:", error);
        }
    }
