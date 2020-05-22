@extends('layouts.app')

@section('title')Library @endsection

@section('content')

    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Название книги</label>
                            <input type="text" name="name" class="form-control" placeholder="Введите название">
                        </div>
                        <div class="form-group">
                            <label>Описание</label>
                            <textarea style="height: 230px;" type="text" name="description" class="form-control" placeholder="Введите описание"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Автор</label>
                            <select name="author_id" class="form-control">
                                <option value="" disabled selected>Выберите автора</option>
                                @foreach($authors as $author)
                                    <option value="{{$author->id}}">{{$author->last_name}} {{$author->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Картинка</label>
                            <input type="file" name="img" class="form-control">
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
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Редактировать</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="books" method="post" id="editForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Название книги</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Введите название">
                        </div>
                        <div class="form-group">
                            <label>Описание</label>
                            <textarea style="height: 230px;" type="text" name="description" id="description" class="form-control" placeholder="Введите описание"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Автор</label>
                            <select name="author_id" class="form-control" id="author_id">
                                <option value="" disabled selected>Выберите автора</option>
                                @foreach($authors as $author)
                                    <option value="{{$author->id}}">{{$author->last_name}} {{$author->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Картинка</label>
                            <input type="file" name="img" id="img" value="" class="form-control"/>
                            <img class="img-fluid" id="upload_img" src="">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal -->

    <div class="container">
        <a href="/">Вернуться назад</a>
        <h1 class="text-center">Все книги</h1>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Добавить книгу
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
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Опубликовано</th>
                    <th scope="col">Картинка</th>
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <th scope="row">{{$book->id}}</th>
                    <td>{{$book->name}}</td>
                    <td>{{$book->description}}</td>
                    <td>{{$book->author->last_name}} {{$book->author->name}}</td>
                    <td>{{$book->created_at}}</td>
                    <td><img class="img-fluid" style="max-width: 200px;" src="{{ asset('uploads/b_covers/'. $book->img) }}" alt="{{$book->img}}"></td>
                    <td>
                        <div>
                            <a href="#" class="btn  btn-primary edit" data-id="{{$book->id}}" data-img="{{ asset('uploads/b_covers/'. $book->img) }}" data-name="{{$book->name}}" data-desc="{{$book->description}}" data-author-id="{{$book->author->id}}">Редактировать</a><br><br>
                            <form action="{{ route('books.destroy', $book->id)}}" method="post" class="mx-2">
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
                }

            });

            $('.edit').click(function () {
                var id = $(this).attr('data-id');
                var name = $(this).attr('data-name');
                var desc = $(this).attr('data-desc');
                var authorId = $(this).attr('data-author-id');
                var img = $(this).attr('data-img');

                $('#name').val(name);
                $('#description').val(desc);
                $('#author_id').val(authorId);
                $("#upload_img").attr("src", img);

                $('#editForm').attr('action', '/books/' + id);
                $('#editModal').modal('show');
            });

        });
    </script>



    @endsection
