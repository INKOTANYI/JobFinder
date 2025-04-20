<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ishakiro Job Solution</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .text-center a {
            color: #007bff;
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        <div id="alert-message" class="alert d-none" role="alert"></div>

        <form id="login-form">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <p class="text-center mt-3">
            Don't have an account? <a href="{{ route('register') }}">Register here</a>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const alertMessage = document.getElementById('alert-message');

            axios.post('{{ route('login') }}', formData)
                .then(response => {
                    alertMessage.classList.remove('d-none', 'alert-danger');
                    alertMessage.classList.add('alert-success');
                    alertMessage.textContent = 'Login successful! Redirecting to dashboard...';
                    setTimeout(() => {
                        window.location.href = '{{ route('dashboard') }}';
                    }, 2000);
                })
                .catch(error => {
                    alertMessage.classList.remove('d-none', 'alert-success');
                    alertMessage.classList.add('alert-danger');
                    if (error.response && error.response.data.errors) {
                        const errors = error.response.data.errors;
                        let errorMessage = '';
                        for (let field in errors) {
                            errorMessage += errors[field][0] + '<br>';
                            const input = document.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('is-invalid');
                                const feedback = input.nextElementSibling;
                                if (feedback && feedback.classList.contains('invalid-feedback')) {
                                    feedback.textContent = errors[field][0];
                                }
                            }
                        }
                        alertMessage.innerHTML = errorMessage;
                    } else if (error.response && error.response.data.message) {
                        alertMessage.textContent = error.response.data.message;
                    } else {
                        alertMessage.textContent = 'An error occurred. Please try again.';
                    }
                });
        });
    </script>
</body>
</html>
