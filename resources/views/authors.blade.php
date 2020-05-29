@extends('layouts.app')

@section('title')Authors @endsection

@section('content')

    <!-- Add Modal -->
    <div class="modal fade" id="AddAuthModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form  id="addAuthForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Имя</label>
                            <input type="text" name="name" class="form-control" required placeholder="Введите имя автора">
                        </div>
                        <div class="form-group">
                            <label>Фамилия</label>
                            <input type="text" name="last_name" class="form-control" min="3" required placeholder="Введите фамилию автора">
                        </div>
                        <div class="form-group">
                            <label>Отчество</label>
                            <input type="text" name="patronymic" class="form-control" placeholder="Введите отчество автора"/>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal -->

    <!-- Edit Modal -->
    <div class="modal fade" id="editAuthModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Редактировать</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="authors" method="post" id="editAuthForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Имя</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Введите имя автора">
                        </div>
                        <div class="form-group">
                            <label>Фамилия</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Введите фамилию автора">
                        </div>
                        <div class="form-group">
                            <label>Отчество</label>
                            <input type="text" name="patronymic" id="patronymic" class="form-control" placeholder="Введите отчество автора"/>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-primary">Обновить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->

    <div class="container">
        <a href="/">Вернуться назад</a>
        <h1 class="text-center">Все авторы</h1>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddAuthModal">
            Добавить автора
        </button>

        <br><br>
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $errors)
                        <li>{{$errors}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>{{\Session::get('success')}}</p>
            </div>
        @endif
        <br>

        <table class="table table-bordered" id="datatable">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Имя</th>
                <th scope="col">Отчество</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @foreach($authors as $author)
                <tr>
                    <th scope="row">{{$author->id}}</th>
                    <td>{{$author->last_name}}</td>
                    <td>{{$author->name}}</td>
                    <td>{{$author->patronymic}}</td>
                    <td>
                        <div class="row mx-2">
                            <a href="#" class="btn  btn-primary edit" data-id="{{$author->id}}" data-name="{{$author->name}}" data-lname="{{$author->last_name}}" data-patron="{{$author->patronymic}}">Редактировать</a>
                            <form action="{{ route('authors.destroy', $author->id)}}" method="post" class="mx-2">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Удалить</button>
                            </form>
                        </div>

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#addAuthForm').on('submit', function (e) {
                e.preventDefault();

                var form = $('#addAuthForm')[0];
                var data = new FormData(form);

                $.ajax({
                    type: "POST",
                    url: "/authors",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#exampleModal').modal('hide')
                        location.reload();
                    },
                    error: function (error) {
                        alert('Данные не могут быть добавлены');
                    }
                });

            })

            var table = $('#datatable').DataTable({
                "language": {
                    "processing": "Подождите...",
                    "search": "Поиск:",
                    "lengthMenu": "Показать _MENU_ записей",
                    "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                    "infoEmpty": "Записи с 0 до 0 из 0 записей",
                    "infoFiltered": "(отфильтровано из _MAX_ записей)",
                    "infoPostFix": "",
                    "loadingRecords": "Загрузка записей...",
                    "zeroRecords": "Записи отсутствуют.",
                    "emptyTable": "В таблице отсутствуют данные",
                    "paginate": {
                        "first": "Первая",
                        "previous": "Предыдущая",
                        "next": "Следующая",
                        "last": "Последняя"
                    },
                    "aria": {
                        "sortAscending": ": активировать для сортировки столбца по возрастанию",
                        "sortDescending": ": активировать для сортировки столбца по убыванию"
                    },
                    "select": {
                        "rows": {
                            "_": "Выбрано записей: %d",
                            "0": "Кликните по записи для выбора",
                            "1": "Выбрана одна запись"
                        }
                    }
                },
                "order": [[ 1, 'asc' ]],
                "pagingType": "numbers",
                "paging": true

            });

            table.page.len( 15 ).draw();

            $('.edit').click(function () {
                $('#editAuthModal').modal('show');

                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                var lname = $(this).attr('data-lname');
                var patronymic = $(this).attr('data-patron');

                $('#id').val(id);
                $('#name').val(name);
                $('#last_name').val(lname);
                $('#patronymic').val(patronymic);

            });

            $('#editAuthForm').on('submit', function (e) {
                e.preventDefault();

                var form = $('#editAuthForm')[0];
                var data = new FormData(form);
                var id = $('#id').val();

                $.ajax({
                    type: "POST",
                    url: "/authors/" + id,
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#editAuthModal').modal('hide')
                        location.reload();
                    },
                    error: function (error) {
                        alert('Данные не могут быть добавлены');
                    }
                });

            })

        });
    </script>


@endsection
