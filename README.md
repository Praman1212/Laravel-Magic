<h1>Let's create ajax Form using jquey and laravel</h1>
<p>Make model name Ajax with migration file</p>
<p style="color:red;">php artisan make:model Ajax -m</p>

<p>Inside migration file</p>

     public function up(): void
    {
        Schema::create('ajaxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->timestamps();
        });
    }
<span>Then in model</span>

    class Ajax extends Model
    {
        use HasFactory;
       protected $fillable = ['name','phone','email'];
    }
<span>Then inside controller</span>


    public function index()
    {
        $items = Ajax::latest()->get();
        return view('ajax.index',compact('items'));
    }


    public function create()
    {
        return view('ajax.create');
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'phone',
            'email'
        ]);
        Ajax::create($data);
        return response()->json([
            'route' => route('ajax.index'),
            'status' => 'Form submitted successfully'
        ]);
    }


    public function show(string $id)
    {
        $item = Ajax::find($id);
        return view('ajax.show', compact('item'));
    }


    public function edit(string $id)
    {
        $item = Ajax::findOrFail($id);
        return view('ajax.create',compact('item'));
    }


    public function update(Request $request, string $id)
    {
        $data = $request->only(['name','email','phone']);
        $item = Ajax::findOrFail($id);
        $item->update($data);
        return response()->json([
            'route' => route('ajax.index'),
            'status' => 'Form updated successfully'
        ]);
    }


    public function destroy(string $id)
    {
        $item = Ajax::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }

<span>The let's make ajax form</span>

        <div id="statusMessage" class="hidden bg-green-700 text-white p-2 rounded"></div>
        
        <form id="ajaxForm" action="{{ isset($item) ? route('ajax.update',$item->id) : route('ajax.store') }}" method="POST">
            @csrf
            
            @if(isset($item))
            
            @method('PUT')
            
            @endif
            <div class="flex flex-row mt-4 bg-gray-200 p-4 rounded-b justify-between">
                <div class="flex items-center w-1/3 p-2">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" class="p-2 rounded w-2/3" placeholder="Enter your name." value="{{ isset($item) ? $item->name : '' }}">
                </div>
                <div class="flex items-center w-1/3 p-2">
                    <label for="phone">Phone: </label>
                    <input type="number" name="phone" id="phone" class="p-2 rounded w-2/3" placeholder="Enter your phone number." value="{{ isset($item) ? $item->phone : '' }}">
                </div>
                <div class="flex items-center w-1/3 p-2">
                    <label for="name1">Email: </label>
                    <input type="text" name="email" id="email" class="p-2 rounded w-2/3" placeholder="Enter your email." value="{{ isset($item) ? $item->email : '' }}">
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" id="ajaxButton" class="bg-blue-900 px-4 py-1 text-white rounded ">{{ isset($item) ? 'Update' : 'Save' }}</button>
            </div>
        </form>

<span>This is script file for jquery code</span>

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
                    sessionStorage.setItem('status', response.status);
                    window.location.href = response.route;
                },
                error: function(xhr, status, error) {
                    console.error(error)
                    alert('Form submission error');
                }
            })

        });
    });
    </script>
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
    function approveMessage(){
        return confirm('Are you sure want to delete the data?')
    }
     </script>


