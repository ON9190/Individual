</main>
<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-section">
            <h4>Соціальні мережі</h4>
            <div class="social-links">
                <a href="#" class="social-link">
                    <i class="fab fa-instagram"></i>
                    Instagram
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-facebook"></i>
                    Facebook
                </a>
            </div>
        </div>
        
        <div class="footer-section">
            <h4>Допомога</h4>
            <a href="#" class="footer-link">FAQ</a>
            <a href="#" class="footer-link">Контакти</a>
            <a href="#" class="footer-link">Правила використання</a>
        </div>
        
        <div class="footer-section">
            <h4>Про нас</h4>
            <p>Ваш надійний партнер у світі соціальних мереж</p>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; <?= date('Y') ?> Всі права захищені</p>
    </div>
</footer>

<style>
.site-footer {
    background-color: #1a1a1a;
    color: #ffffff;
    padding: 40px 0 20px;
    margin-top: 50px;
    width: 100%;
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    padding: 0 20px;
}

.footer-section h4 {
    color: #ffffff;
    margin-bottom: 20px;
    font-size: 1.2em;
}

.social-links {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.social-link {
    color: #ffffff;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: color 0.3s ease;
}

.social-link:hover {
    color: #007bff;
}

.footer-link {
    color: #ffffff;
    text-decoration: none;
    display: block;
    margin-bottom: 10px;
    transition: color 0.3s ease;
}

.footer-link:hover {
    color: #007bff;
}

.footer-bottom {
    text-align: center;
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid #333;
}

/* Адаптивність */
@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .social-links {
        align-items: center;
    }
}
</style>

<!-- Font Awesome для іконок -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="/project-root/assets/js/main.js"></script>
</body>
</html>
