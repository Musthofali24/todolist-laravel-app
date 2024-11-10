<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- 00. Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid col-md-7">
            <div class="navbar-brand">Simple To Do List {{ $name }}</div>
            <!--
            <div class="navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Akun Saya
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                            <li><a class="dropdown-item" href="#">Update Data</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        -->
        </div>
    </nav>

    <div class="container mt-4">
        <!-- 01. Content-->
        <h1 class="mb-4 text-center">Selamat Datang {{ $name }}</h1>
        <p class="mb-4 text-center">Silahkan isi todolist hari <span class="font-weight-bold"> {{ date('l, d F Y') }}
            </span>
        </p>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mb-3 card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- 02. Form input data -->
                        <form id="todo-form" action="{{ route('todo.post') }}" method="post">
                            @csrf
                            <div class="mb-3 input-group">
                                <input type="text" class="form-control" name="task" id="todo-input"
                                    placeholder="Tambah task baru" value="{{ old('task') }}" required>
                                <button class="btn btn-primary" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- 03. Searching -->
                        <form id="todo-form" action="" method="get">
                            <div class="mb-3 input-group">
                                <input type="text" class="form-control" name="search" value=""
                                    placeholder="masukkan kata kunci">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>

                        <ul class="mb-4 list-group" id="todo-list">
                            @foreach ($tasks as $task)
                                <!-- 04. Display Data -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="task-text">
                                        {!! $task->is_done == '1' ? '<del>' : '' !!}
                                        {{ $task->task }}
                                        {!! $task->is_done == '1' ? '</del>' : '' !!}
                                    </span>
                                    <input type="text" class="form-control edit-input" style="display: none;"
                                        value="{{ $task->task }}">
                                    <div class="btn-group">
                                        <form action="{{ route('todo.delete', ['id' => $task->id]) }}" method="POST"
                                            onsubmit="return confirm('Yakin akan menghapus data ini?')">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm delete-btn">✕</button>
                                        </form>
                                        <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $loop->index }}"
                                            aria-expanded="false">✎</button>
                                    </div>
                                </li>
                                <!-- 05. Update Data -->
                                <li class="list-group-item collapse" id="collapse-{{ $loop->index }}">
                                    <form action="{{ route('todo.update', ['id' => $task->id]) }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <div>
                                            <div class="mb-3 input-group">
                                                <input type="text" class="form-control" name="task"
                                                    value="{{ $task->task }}">
                                                <button class="btn btn-outline-primary" type="submit">Update</button>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="px-2 radio">
                                                <label>
                                                    <input type="radio" value="1" name="is_done"
                                                        {{ $task->is_done == '1' ? 'checked' : '' }}> Selesai
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" value="0" name="is_done"
                                                        {{ $task->is_done == '0' ? 'checked' : '' }}> Belum
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            @endforeach
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
