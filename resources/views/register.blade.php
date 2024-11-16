<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <!-- Favicons -->
  <link href="{{ asset('images/icons/BCIL2.png') }}" rel="icon">
  <link href="{{ asset('images/icons/BCIL2.png') }}" rel="apple-touch-icon">

    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <!-- Menggunakan CDN Bootstrap untuk styling dan modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ6H7Km6v35uo5bd1z1gn6nHR2FJlL1bD2i4Vc3Lf4+Azm74CpX4C/Alk5P0J" crossorigin="anonymous">
</head>
<body>
    <h1>Form Registrasi</h1>

    <!-- Form Registrasi -->
    <form action="{{ route('register.store') }}" method="POST">
        @csrf

        <label for="student_name">Nama Lengkap:</label>
        <input type="text" name="student_name" id="student_name" value="{{ old('student_name') }}" required>
        @error('student_name') <span class="error">{{ $message }}</span> @enderror
        <br>

        <label for="student_grade">Kelas:</label>
        <input type="text" name="student_grade" id="student_grade" value="{{ old('student_grade') }}" required>
        @error('student_grade') <span class="error">{{ $message }}</span> @enderror
        <br>

        <label for="school_id">Sekolah:</label>
        <select name="school_id" id="school_id" required>
            <option value="">Pilih Sekolah</option>
            @foreach ($schools as $school)
                <option value="{{ $school->school_id }}">{{ $school->school_name }}</option>
            @endforeach
        </select>
        @error('school_id') <span class="error">{{ $message }}</span> @enderror
        <br>

        <label for="type_id">Tipe:</label>
        <select name="type_id" id="type_id" required>
            <option value="">Pilih Tipe</option>
            @foreach ($types as $type)
                <option value="{{ $type->type_id }}">{{ $type->type_name }}</option>
            @endforeach
        </select>
        @error('type_id') <span class="error">{{ $message }}</span> @enderror
        <br>

        <label for="student_address">Alamat:</label>
        <input type="text" name="student_address" id="student_address" value="{{ old('student_address') }}" required>
        @error('student_address') <span class="error">{{ $message }}</span> @enderror
        <br>

        <label for="student_phone">Nomor Telepon:</label>
        <input type="text" name="student_phone" id="student_phone" value="{{ old('student_phone') }}" required>
        @error('student_phone') <span class="error">{{ $message }}</span> @enderror
        <br>

        <label for="student_email">Email:</label>
        <input type="email" name="student_email" id="student_email" value="{{ old('student_email') }}" required>
        @error('student_email') <span class="error">{{ $message }}</span> @enderror
        <br>

        <label for="student_dob">Tanggal Lahir:</label>
        <input type="date" name="student_dob" id="student_dob" value="{{ old('student_dob') }}" required>
        @error('student_dob') <span class="error">{{ $message }}</span> @enderror
        <br>

        <label for="student_regist_date">Pilih Hari:</label>
        <input type="date" name="student_regist_date" id="student_regist_date" value="{{ old('student_regist_date') }}" required>
        @error('student_regist_date') <span class="error">{{ $message }}</span> @enderror
        <br>

        <button type="submit">Daftar</button>
    </form>

    <!-- Modal Pop-up untuk Menampilkan Pemberitahuan Sukses -->
    @if(session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Pemberitahuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Menampilkan modal setelah berhasil registrasi
        var myModal = new bootstrap.Modal(document.getElementById('successModal'));
        myModal.show();
    </script>
    @endif

    <!-- Tambahkan link ke file JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8Fq+pt3hJ4SxQp2oyJ+Tk9T2Vyw/1lIVvoQzVjHrfuSggX" crossorigin="anonymous"></script>
</body>
</html>
