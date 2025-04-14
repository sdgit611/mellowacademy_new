{{-- @extends('front.layout')
@section('content') --}}
 <!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>
    <style>
        .star {
            font-size: 30px;
            color: gray;
            cursor: pointer;
        }
        .star.selected {
            color: gold;
        }
    </style>
</head>
<body> 
    @if(session('success'))
    <div id="success-message" style="padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>

    <script>
        // Hide the message after 3 seconds
        setTimeout(() => {
            const msg = document.getElementById('success-message');
            if (msg) {
                msg.style.transition = 'opacity 0.5s ease';
                msg.style.opacity = '0';
                setTimeout(() => msg.remove(), 500); // Remove from DOM after fade out
            }
        }, 3000);
    </script>
    @endif

    
    <div id="feedback-form" style="display:block;">

        <form action="{{ route('feedback.store') }}" method="POST">
            @csrf

            <p>1. Communication Score</p>
            <div>
                @for($i=1; $i<=10; $i++)
                    <span class="star" onclick="setRating('comm', {{ $i }})" id="comm-star-{{ $i }}">★</span>
                @endfor
                <input type="hidden" name="communication_score" id="comm-score" value="0">
            </div>
            <textarea name="communication_remark" placeholder="Remark"></textarea>

            <p>2. Coding Score</p>
            <div>
                @for($i=1; $i<=10; $i++)
                    <span class="star" onclick="setRating('code', {{ $i }})" id="code-star-{{ $i }}">★</span>
                @endfor
                <input type="hidden" name="coding_score" id="code-score" value="0">
            </div>
            <textarea name="coding_remark" placeholder="Remark"></textarea>

            <input type="hidden" name="status" id="feedback-status" value="submitted">

            <br><br>
            <button type="submit" onclick="setStatus('selected')">Selected</button>
            <button type="submit" onclick="setStatus('submitted')">Submit</button>
            <button type="submit" onclick="setStatus('rejected')">Rejected</button>
        </form>
    </div>

    <script>
        function setRating(type, value) {
            document.getElementById(type + '-score').value = value;
            for (let i = 1; i <= 10; i++) {
                document.getElementById(type + '-star-' + i).classList.remove('selected');
                if (i <= value) {
                    document.getElementById(type + '-star-' + i).classList.add('selected');
                }
            }
        }

        function setStatus(status) {
            document.getElementById('feedback-status').value = status;
        }
    </script>
</body>
</html>
{{-- @endsection --}}