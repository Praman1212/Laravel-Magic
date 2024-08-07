<h1>Partial View Form using AJAX</h1>
<span>Controller</span>

    public function index()
    {
        $items = Ajax::latest()->get();
        return view('ajax.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ajax.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'phone',
            'email'
        ]);
        
        // partial view concept
        Ajax::create($data);
        $items = Ajax::all();
        $partialView = view('ajax.table', ['items' => $items])->render();
        return response()->json([
            'data' => $partialView,
            'url' => route('ajax.index')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Ajax::find($id);
        return view('ajax.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Ajax::findOrFail($id);
        $partialView = view('ajax.create',['item' => $item])->render();
        return response()->json([
            'data' => $partialView,
            'url' => route('ajax.show',$item->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['name', 'email', 'phone']);
        $item = Ajax::findOrFail($id);
        $item->update($data);
        $items = Ajax::all();
        $partialView = view('ajax.table', ['items' => $items])->render();
        return response()->json([
            'data' => $partialView,
            'url' => route('ajax.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Ajax::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }


<span>Script</span>

<!-- Ajax Form submit for create.blade.php -->
    <script>
        $(document).ready(function() {
            $('#ajaxForm').on('submit', function(event) {
                event.preventDefault();
                var dataItem = $(this).serialize();
                var url = $('#ajaxForm').attr('action');
                var method = '{{ isset($item) ? 'PUT' : 'POST' }}';
                $.ajax({
                    url: url,
                    type: method,
                    data: dataItem,
                    success: function(response) {
                        console.log(response)
                        // partial view concept
                        if (response.url) {
                            history.pushState(null, '', response.url);
                            $('.partial-view').empty();
                            $('.partial-view').append(response.data)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error)
                        alert('Form submission error');
                    }
                })
    
            });
        });
    </script>

<!-- Edit button of ajax form -->
    <script>
        $(document).ready(function() {
            // When you use data-id attribute then use this ho handle the click event
            $(document).on('click', '#ajax-edit-button', function(event) {
                event.preventDefault();
                var id = $(this).data('id');
                var url = '/ajax/' +id+ '/edit' ;
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response){
                        console.log(response)
                        if(response.url){
                            history.pushState(null,'',response.url);
                            $('.here').empty();
                            $('.here').append(response.data);
                        }
                    }
                })
            });
        })
    </script>
<!--  -->

<!-- To get the status message -->
    <script>
        $(document).ready(function() {
            var statusMessage = sessionStorage.getItem('status');
            if (statusMessage) {
                $('#statusMessage').text(statusMessage).removeClass('hidden');
                setTimeout(function() {
                    $('#statusMessage').addClass('hidden')
                    sessionStorage.removeItem('status');
                }, 2000);
            }
        });
    </script>
<!-- For delete message -->
    <script>
        function approveMessage() {
            return confirm('Are you sure want to delete the data?')
        }
    </script>

