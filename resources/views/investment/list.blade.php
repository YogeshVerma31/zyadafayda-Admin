<!DOCTYPE html>
<html lang="en">
@include('includes.head')

<body>
    <div class="container-scroller">
        @include('includes.header')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            @include('includes.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="card">

                        <div class="card-body">

                            <div class="m-2 justify-content-center">
                                <h4 class="card-title m-2 d-block">Investment Company List</h4>
                                <a href="add-investment" class="ml-3 btn btn-primary">Add Investment Company</a>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="order-listing" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Actions</th>
                                                    <th>Id #</th>
                                                    <th>Investment Company Image</th>
                                                    <th>Investment Company Title</th>
                                                    <th>Investment Company Sub Title</th>
                                                    <th>Investment Company Link</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($investmentList as $result)
                                                <tr class="odd">
                                                    <td class="text-center">

                                                        <a class="text-primary mr-2"
                                                            href="{{ route('edit-investment', $result->id) }}">
                                                            <span class="btn btn-sm btn-primary">
                                                                <i class="nav-icon i-Pen-3"></i> edit
                                                            </span>
                                                        </a>

                                                        <form action="{{ route('deleteInvestment', $result->id) }}"
                                                            method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <input type="submit"
                                                                onclick="return confirm('are you sure to want delete?')"
                                                                class="text-white btn btn-danger mt-3"
                                                                value="Delete" />
                                                        </form>

                                                    </td>
                                                    <td class="sorting_1">{{ $result->id }}</td>
                                                    <td class="text-right">{{ substr($result->title, 0, 26) }}</td>
                                                    <td class="text-right">{{ substr($result->sub_title, 0, 26) }}</td>
                                                    <td>
                                                        <a href="{{ Storage::url($result->logo) }}"
                                                            target="_blank"><img style="width:80px;height:80px"
                                                                src="{{ Storage::url($result->logo) }}" /></a>
                                                    </td>
                                                    <td class="text-right">{{ $result->link }}</td>

                                                    <td> @if($result->status=='0')
                                                        <a href="{{ route('updateInvestmentStatus', ['id' => $result->id]) }}" class="btn-sm btn btn-danger waves-effect waves-light">inactive</a>
                                                        @else
                                                        <a href="{{ route('updateInvestmentStatus', ['id' => $result->id]) }}" class="btn-sm btn btn-success waves-effect waves-light">active</a>
                                                        @endif

                                                    </td>
                                                    <td class="text-right">{{ $result->created_at }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- partial -->
                        </div>
                        <!-- main-panel ends -->
                    </div>
                    <!-- page-body-wrapper ends -->
                </div>
                @include('includes.footer')
                <script>
                    new DataTable('#example');
                </script>
</body>

</html>
