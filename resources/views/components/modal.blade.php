

    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
    </button> --}}

    <!-- Bootstrap Modal -->
    <div 
        class="modal fade" 
        id="{{ $attributes->get("id") }}" 
        tabindex="-1" 
        aria-labelledby="exampleModalLabel" 
        {{-- aria-hidden="true" --}}
        >
        
        <div class="modal-dialog">
            <div class="modal-content">
            
                {{-- {{ $slot }} --}}

            </div>

        </div>
    </div>