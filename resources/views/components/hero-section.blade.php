<style>
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        padding: 3rem 2.5rem;
        margin-bottom: 0.5rem;
        color: white;
    }

    .hero-content {
        text-align: center;
        justify-content: center;
    }

    .hero-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 0.75rem;
        line-height: 1.3;
        background: linear-gradient(135deg, #ffffff 0%, #e3f2fd 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        opacity: 0.95;
        font-weight: 500;
        color: white;
    }
</style>

<section class="hero-section">
    <div class="hero-content">
        <div>
            <h1 class="hero-title">{{ $title }}</h1>
            <p class="hero-subtitle">{{ $subtitle }}</p>
        </div>
    </div>
</section>
