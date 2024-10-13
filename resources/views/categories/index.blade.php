 <table>
    <thead>
        <tr>
            <th>Category Name</th>
            <th>Number of Cars</th>
        </tr>
    </thead>
    <tbody>
        @if($categories->isEmpty())
            <tr>
                <td colspan="2">No categories found.</td>
            </tr>
        @else
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->category_name }}</td>
                <td>{{ $category->cars_count }}</td>
            </tr>
            @endforeach
        @endif
    </tbody> 