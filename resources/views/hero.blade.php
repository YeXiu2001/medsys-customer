<!doctype html>
<html lang="en">
@include('layouts.components.head')
<style>
    #hero-section {
        background-image: url('/assets/images/hero-3.jpg');
        background-size: cover; /* Ensures the image covers the entire section */
        background-position: center; /* Centers the image */
        background-repeat: no-repeat; /* Prevents tiling */
        min-height: 100vh; /* Full viewport height */
        min-width: 100vw; /* Full viewport width */
        display: flex; /* Enables centering content */
        justify-content: center; /* Horizontally centers content */
        align-items: center; /* Vertically centers content */
        text-align: center;
        position: relative; /* Allows layering of elements */
    }

    .hero-content {
        padding-left: 2rem; /* Adds spacing inside the content */
        padding-right: 2rem;
        padding-top: 5rem; /* Adds more spacing at the top */
        padding-bottom: 5rem;
        border-radius: 1rem; /* Optional: rounds the corners */
        color: white; /* Ensures text is readable */
        min-width: 80rem; /* Limits content width for better readability */
        backdrop-filter: blur(7px); /* Adds a subtle blur effect */
    }

    .hero-content .btn:hover {
        background-color: #0056b3;
    }
    @media (min-width: 769px) and (max-width: 1283px) {
        #hero-section {
            height: auto;
            padding: 2rem 0;
            min-height: 100vh; /* Ensures minimum height is full viewport on mobile */
        }
        .hero-content {
            min-width: auto;
            padding: 2rem;
            max-width: 90%;
        }

    }

    @media (max-width: 768px) {
        #hero-section {
            height: auto;
            padding: 2rem 0;
            min-height: 100vh; /* Ensures minimum height is full viewport on mobile */
        }

        .hero-content {
            min-width: auto;
            padding: 2rem;
            max-width: 90%;
        }

        .display-1 {
            font-size: 2rem;
        }

        .display-3 {
            font-size: 1.5rem;
        }

        .tagline {
            font-size: 0.8rem !important;
        }

        .btn {
            width: 100%;
            margin-bottom: 0.5rem;
            padding-top:0.3rem;
            padding-bottom:0.3rem;
        }
    }
</style>
<body>
    <section id="hero-section" class="hero">
        <div class="hero-content shadow-lg">
            <h1 class="display-1 fw-bold" style="color:rgb(31, 207, 223); text-shadow: 2px 2px 4px #1b263b;">MedSYS</h1>
            <h2 class="display-3 fw-semibold" style="text-shadow: 2px 2px 4px #1b263b">Simplify Your Search</h2>
            <p class="fs-2 tagline">Make your health journey easier by connecting you with trusted pharmacies at your fingertips!</p>
            <a href="/customer/login" class="btn btn-lg btn-primary px-5">Login</a>
            <a href="/customer/register" class="btn btn-lg btn-secondary px-5">Register</a>
        </div>
    </section>
    @include('layouts.components.script')
</body>
</html>