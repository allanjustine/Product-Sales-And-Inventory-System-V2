<div>
    <div class="bg-cover">
        <div class="content">
            <div class="message-box bg-secondary">
                <h1 class="fw-bold">
                    @if (session('verified'))
                    {{ session('verified')['title'] }}
                    @elseif (session('alreadyVerified'))
                    {{ session('alreadyVerified')['title'] }}
                    @elseif (session('invalidToken'))
                    {{ session('invalidToken')['title'] }}
                    @endif
                </h1>
                <p> @if (session('verified'))
                    {{ session('verified')['message'] }}
                    @elseif (session('alreadyVerified'))
                    {{ session('alreadyVerified')['message'] }}
                    @elseif (session('invalidToken'))
                    {{ session('invalidToken')['message'] }}
                    @endif</p>
            </div>
        </div>
    </div>

    <style>
        .bg-cover {
            background-size: cover;
            height: 100vh;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .message-box {
            color: #fff;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            max-width: 600px;
            width: 100%;
        }

        .message-box h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .message-box p {
            font-size: 1.25rem;
            margin-bottom: 30px;
        }
    </style>

    @if(session('verified'))
    <script>
        const {
            title
            , message
            , type
        } = @json(session('verified'));
        Swal.fire({
            title: title
            , text: message
            , icon: type
            , confirmButtonText: 'OK'
            , showCloseButton: true,

        });

    </script>
    @endif

    @if(session('alreadyVerified'))
    <script>
        const {
            title
            , message
            , type
        } = @json(session('alreadyVerified'));
        Swal.fire({
            title: title
            , text: message
            , icon: type
            , confirmButtonText: 'OK'
            , showCloseButton: true,

        });

    </script>
    @endif

    @if(session('invalidToken'))
    <script>
        const {
            title
            , message
            , type
        } = @json(session('invalidToken'));
        Swal.fire({
            title: title
            , text: message
            , icon: type
            , confirmButtonText: 'OK'
            , showCloseButton: true,

        });

    </script>
    @endif

    <script>
        setTimeout(() => {
            window.close();
        }, 5000);
    </script>
</div>
