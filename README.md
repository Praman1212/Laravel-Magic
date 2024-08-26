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


    <h3>Ajax Form submit for create.blade.php</h3>  
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

    <h3>Edit button of ajax form </h3>
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

    <h3>To get the status message</h3>
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
    <h3>For delete message</h3>
    <script>
        function approveMessage() {
            return confirm('Are you sure want to delete the data?')
        }
    </script>



<!-- API -->
<!-- Create model, migration, controller and resource  -->
<!-- php artisan make:resource TodoResource -->
<!-- Give the route for api in api.php  -->
<!-- Inside TodoResource 
     $data = [
            'id' => $this->id,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'image'=> asset('uploads/todo'.$this->image)
        ];

        return $data;
 -->
 <!-- Inside TodoController 
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Todo::all();

        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => TodoResources::collection($data),
            'message' => 'Todo List data fetched successfully.'
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'image'
        ]);
        // php artisan storage:link
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $hashedName = md5($image->getClientOriginalName() . time()) . '.' . $image->extension();
            $imagePath = $image->storeAs('uploads/todo', $hashedName, 'public');
            $data['image'] = $imagePath;
        }
        $item = Todo::create($data);
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => new TodoResources($item),
            'message' => "Data stored successfully"
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Todo::find($id);
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => new TodoResources($data),
            'message' => 'Data shown successfully.'
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Todo::find($id);
        $data = $request->only([
            'title',
            'image'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $hashedName = md5($image->getClientOriginalName() . time()) . '.' . $image->extension();
            $imagePath = $image->storeAs('uploads/todo', $hashedName, 'public');
            $data['image'] = $imagePath;
        }
        $item->update($data);
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => new TodoResources($item),
            'message' => 'Data updated successfully'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Todo::find($id);
        $data->delete();
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => new TodoResources($data),
            'message' => "Data deleted successfully"
        ], Response::HTTP_OK);
    }
  -->