@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }
    .recipe-card {
        max-width: 900px;
        margin: 50px auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s;
    }
    .recipe-card:hover {
        transform: translateY(-5px);
    }
    .recipe-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    .recipe-content {
        padding: 30px;
    }
    h1 {
        font-size: 2.2em;
        color: #333;
        text-align: center;
        margin-bottom: 15px;
    }
    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 30px;
    }
    .action-buttons button {
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
    }
    .action-buttons button:hover {
        transform: translateY(-2px);
    }
    .like-btn { background: #FF6B6B; color: #fff; }
    .like-btn:hover { background: #FF4C4C; }
    .save-btn { background: #1DD1A1; color: #fff; }
    .save-btn:hover { background: #10ac84; }

    .section-title {
        font-size: 1.4em;
        color: #555;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 8px;
        margin-bottom: 15px;
    }
    .ingredient, .instruction, .comment {
        background: #f9f9f9;
        padding: 12px 18px;
        border-radius: 10px;
        margin-bottom: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .ingredient:hover, .instruction:hover, .comment:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    ol { padding-left: 20px; line-height: 1.8; color: #444; }
    ul { list-style: none; padding-left: 0; }

    .comment-user {
        font-weight: bold;
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 5px;
    }
    .comment-user img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
    }
    .comment-content {
        color: #555;
    }

    @media (max-width: 768px) {
        .recipe-card { margin: 20px; }
        .recipe-image { height: 250px; }
        h1 { font-size: 1.8em; }
    }
</style>

<div class="recipe-card">
    @if(isset($recipe->image))
        <img src="{{ $recipe->image }}" alt="{{ $recipe->title }}" class="recipe-image">
    @endif

    <div class="recipe-content">
        <h1>{{ $recipe->title }}</h1>

        <div class="action-buttons">
            <button class="like-btn">❤️ Curtir</button>
            <button class="save-btn">💾 Salvar</button>
        </div>

        {{-- Ingredientes --}}
        <div>
            <h2 class="section-title">Ingredientes</h2>
            @if(isset($recipe->ingredients) && is_array($recipe->ingredients))
                <ul>
                    @foreach($recipe->ingredients as $ingredient)
                        <li class="ingredient">{{ $ingredient }}</li>
                    @endforeach
                </ul>
            @else
                <p style="color:#999;">Nenhum ingrediente disponível.</p>
            @endif
        </div>

        {{-- Instruções --}}
        <div>
            <h2 class="section-title">Como Fazer</h2>
            @if(isset($recipe->instructions) && is_array($recipe->instructions))
                <ol>
                    @foreach($recipe->instructions as $step)
                        <li class="instruction">{{ $step }}</li>
                    @endforeach
                </ol>
            @else
                <p style="color:#999;">Instruções não disponíveis.</p>
            @endif
        </div>

        {{-- Comentários --}}
        <div>
            <h2 class="section-title">Comentários</h2>
            @if(isset($comments) && count($comments) > 0)
                @foreach($comments as $comment)
                    <div class="comment">
                        <div class="comment-user">
                            <img src="{{ $comment->user->avatar ?? 'https://via.placeholder.com/35' }}" alt="{{ $comment->user->name ?? 'Anônimo' }}">
                            {{ $comment->user->name ?? 'Anônimo' }}
                        </div>
                        <div class="comment-content">{{ $comment->content }}</div>
                    </div>
                @endforeach
            @else
                <p style="color: #999;">Ainda não há comentários.</p>
            @endif
        </div>

    </div>
</div>
@endsection
