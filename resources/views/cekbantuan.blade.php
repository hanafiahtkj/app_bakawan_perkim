<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Bantuan PKP</title>
    <meta name="description" content="Portal PKP">
    <link rel="preconnect" href="https://my.pkp.go.id">
    <link rel="dns-prefetch" href="https://my.pkp.go.id">

    <style>
        /* CSS Reset & Base */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --primary: #0f172a;
            --primary-light: #1e293b;
            --secondary: #3b82f6;
            --accent: #06b6d4;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --surface: #ffffff;
            --surface-alt: #f8fafc;
            --surface-dark: #f1f5f9;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --text: #1e293b;
            --text-muted: #64748b;
            --text-light: #94a3b8;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --backdrop-blur: blur(20px);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --radius: 1rem;
            --radius-sm: 0.5rem;
            --radius-lg: 1.5rem;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, var(--surface-alt) 0%, var(--surface-dark) 100%);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Loading Animation */
        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translate3d(0, -100%, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 30px, 0);
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Header */
        .header {
            position: sticky;
            top: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: var(--backdrop-blur);
            border-bottom: 1px solid var(--border);
            padding: 1rem 0;
            z-index: 1000;
            animation: slideInDown 0.6s ease-out;
        }

        .header-content {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo {
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(135deg, var(--secondary), var(--accent));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.125rem;
            box-shadow: var(--shadow);
        }

        .title {
            font-size: clamp(1.25rem, 2.5vw, 1.5rem);
            font-weight: 700;
            color: var(--primary);
            margin: 0;
        }

        .subtitle {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin: 0;
        }

        .header-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            background: var(--surface);
            color: var(--text);
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            white-space: nowrap;
            user-select: none;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }

        .btn:hover::before {
            transform: translateX(100%);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            border-color: var(--primary);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary), var(--accent));
            color: white;
            border-color: var(--secondary);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        /* Main Content */
        .main {
            flex: 1;
            max-width: 1800px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
            width: 100%;
            animation: slideInUp 0.8s ease-out;
        }

        .container {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            animation: scaleIn 1s ease-out;
        }

        .container:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
        }

        .info-banner {
            background: linear-gradient(135deg, var(--surface-alt), var(--surface-dark));
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .info-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary), var(--accent), var(--success));
        }

        .info-content {
            display: flex;
            align-items: start;
            gap: 1rem;
        }

        .info-icon {
            flex-shrink: 0;
            width: 2rem;
            height: 2rem;
            background: linear-gradient(135deg, var(--secondary), var(--accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.875rem;
        }

        .info-text {
            flex: 1;
        }

        .info-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
        }

        .info-description {
            font-size: 0.875rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .url-highlight {
            color: var(--secondary);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .url-highlight:hover {
            color: var(--accent);
        }

        /* Status Indicators */
        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: var(--radius);
            font-size: 0.875rem;
            font-weight: 500;
            margin-top: 1rem;
        }

        .status-loading {
            background: rgba(59, 130, 246, 0.1);
            color: var(--secondary);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .status-error {
            background: rgba(239, 68, 68, 0.1);
            color: var(--error);
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .status-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .spinner {
            width: 1rem;
            height: 1rem;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Iframe Container */
        .iframe-container {
            position: relative;
            width: 100%;
            height: calc(100vh - 400px);
            min-height: 600px;
            background: var(--surface-alt);
        }

        .iframe-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(45deg, rgba(59, 130, 246, 0.1), rgba(6, 182, 212, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 1rem;
            z-index: 2;
            transition: var(--transition);
        }

        .iframe-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .loading-content {
            text-align: center;
        }

        .loading-spinner {
            width: 3rem;
            height: 3rem;
            border: 3px solid var(--border);
            border-top: 3px solid var(--secondary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }

        .loading-text {
            font-size: 1rem;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 0.5rem;
        }

        .loading-subtext {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .iframe-frame {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 0;
            overflow-x: none;
            background: var(--surface);
            transition: var(--transition);
            opacity: 0;
        }

        .iframe-frame.loaded {
            opacity: 1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
                padding: 0 1rem;
            }

            .header-actions {
                width: 100%;
                justify-content: center;
            }

            .main {
                padding: 1rem;
            }

            .info-content {
                flex-direction: column;
                text-align: center;
            }

            .btn {
                flex: 1;
                justify-content: center;
            }

            .iframe-container {
                height: calc(100vh - 250px);
            }

            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
        }

        @media (max-width: 480px) {
            .title {
                font-size: 1.125rem;
            }

            .btn {
                padding: 0.625rem 1rem;
                font-size: 0.8125rem;
            }
        }

        /* Accessibility */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* High contrast mode */
        @media (prefers-contrast: high) {
            :root {
                --border: #000000;
                --text-muted: #000000;
            }
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            :root {
                --primary: #f8fafc;
                --surface: #1e293b;
                --surface-alt: #334155;
                --surface-dark: #475569;
                --text: #f8fafc;
                --text-muted: #cbd5e1;
                --border: #475569;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header" role="banner">
        <div class="header-content">
            <div class="header-title">
                <div>
                    <h1 class="title">Bakawan RTLH</h1>
                    <div class="info-content">
                        <div class="info-icon" aria-hidden="true">ℹ</div>
                        <div class="info-text">
                            <p class="info-description">
                                Halaman ini menampilkan situs resmi
                                <a href="https://my.pkp.go.id/cekbantuan" class="url-highlight" target="_blank"
                                    rel="noopener noreferrer">
                                    my.pkp.go.id/cekbantuan
                                </a>
                                untuk pengecekan desil DTSEN.
                                Jika halaman tidak dapat dimuat, gunakan tombol "Tab Baru" untuk akses langsung.
                            </p>
                            <div id="connection-status"></div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="header-actions" role="navigation">
                <button class="btn" onclick="IframeManager.reload()" aria-label="Muat ulang halaman PKP"
                    title="Muat ulang halaman PKP">
                    <span aria-hidden="true">↻</span>
                    Muat Ulang
                </button>
                <button class="btn" onclick="FullscreenManager.toggle()" aria-label="Alihkan mode layar penuh"
                    title="Layar Penuh">
                    <span aria-hidden="true">⛶</span>
                    Layar Penuh
                </button>
                <button class="btn btn-primary" onclick="NavigationManager.openInNewTab()"
                    aria-label="Buka PKP di tab baru" title="Buka di tab baru">
                    <span aria-hidden="true">↗</span>
                    Tab Baru
                </button>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main" role="main">
        <div class="container">
            <div class="iframe-container" role="application" aria-label="Portal PKP dalam iframe">
                <div class="iframe-overlay" id="iframe-overlay">
                    <div class="loading-content">
                        <div class="loading-spinner" aria-hidden="true"></div>
                        <div class="loading-text">Memuat Portal PKP</div>
                        <div class="loading-subtext">Mohon tunggu sebentar...</div>
                    </div>
                </div>
                <iframe id="pkp-iframe" class="iframe-frame" src="https://my.pkp.go.id/cekbantuan"
                    title="Portal Cek Bantuan PKP" loading="lazy" referrerpolicy="no-referrer"
                    sandbox="allow-same-origin allow-scripts allow-forms allow-popups allow-top-navigation-by-user-activation allow-downloads"
                    aria-label="Portal resmi untuk cek bantuan PKP"></iframe>
            </div>
        </div>
    </main>




    <script>
        'use strict';

        class Logger {
            static log(message, type = 'info') {
                const timestamp = new Date().toISOString();
                console[type](`[${timestamp}] ${message}`);
            }

            static error(message, error) {
                this.log(`ERROR: ${message}`, 'error');
                if (error) console.error(error);
            }
        }

        class StatusManager {
            constructor(containerId) {
                this.container = document.getElementById(containerId);
            }

            show(type, message, details = '') {
                if (!this.container) return;

                const icons = {
                    loading: '<span class="spinner"></span>',
                    success: '✓',
                    error: '⚠',
                    info: 'ℹ'
                };

                this.container.innerHTML = `
                    <div class="status-indicator status-${type}">
                        ${icons[type] || icons.info}
                        <span>${message}</span>
                        ${details ? `<small>${details}</small>` : ''}
                    </div>
                `;
            }

            hide() {
                if (this.container) {
                    this.container.innerHTML = '';
                }
            }
        }

        class EventManager {
            constructor() {
                this.listeners = new Map();
            }

            on(event, callback) {
                if (!this.listeners.has(event)) {
                    this.listeners.set(event, []);
                }
                this.listeners.get(event).push(callback);
            }

            emit(event, data) {
                const callbacks = this.listeners.get(event);
                if (callbacks) {
                    callbacks.forEach(callback => {
                        try {
                            callback(data);
                        } catch (err) {
                            Logger.error(`Event callback error for ${event}`, err);
                        }
                    });
                }
            }
        }

        class IframeInterface {
            static getElement() {
                return document.getElementById('pkp-iframe');
            }

            static getOverlay() {
                return document.getElementById('iframe-overlay');
            }

            static showLoading() {
                const overlay = this.getOverlay();
                if (overlay) overlay.classList.remove('hidden');
            }

            static hideLoading() {
                const overlay = this.getOverlay();
                if (overlay) overlay.classList.add('hidden');
            }
        }

        class IframeManager {
            constructor(eventManager, statusManager) {
                this.eventManager = eventManager;
                this.statusManager = statusManager;
                this.iframe = IframeInterface.getElement();
                this.loadTimeout = null;
                this.retryCount = 0;
                this.maxRetries = 3;

                this.init();
            }

            init() {
                if (!this.iframe) {
                    Logger.error('Iframe element not found');
                    return;
                }

                this.setupEventListeners();
                this.startLoadMonitor();
                Logger.log('IframeManager initialized');
            }

            setupEventListeners() {
                this.iframe.addEventListener('load', () => this.handleLoad());
                this.iframe.addEventListener('error', () => this.handleError());

                window.addEventListener('online', () => this.handleOnline());
                window.addEventListener('offline', () => this.handleOffline());

                document.addEventListener('visibilitychange', () => {
                    if (!document.hidden) {
                        this.checkIframeHealth();
                    }
                });
            }

            startLoadMonitor() {
                IframeInterface.showLoading();
                this.statusManager.show('loading', 'Memuat portal PKP...', 'Menghubungkan ke server');

                this.loadTimeout = setTimeout(() => {
                    this.handleLoadTimeout();
                }, 15000);
            }

            handleLoad() {
                clearTimeout(this.loadTimeout);
                setTimeout(() => {
                    IframeInterface.hideLoading();
                    this.iframe.classList.add('loaded');
                    this.statusManager.show('success', 'Portal berhasil dimuat', '');
                    setTimeout(() => this.statusManager.hide(), 3000);
                }, 500);

                this.retryCount = 0;
                this.eventManager.emit('iframe:loaded', {
                    success: true
                });
                Logger.log('Iframe loaded successfully');
            }

            handleError() {
                clearTimeout(this.loadTimeout);
                IframeInterface.hideLoading();
                this.statusManager.show('error', 'Gagal memuat portal', 'Coba muat ulang atau buka di tab baru');
                this.eventManager.emit('iframe:error', {
                    retryCount: this.retryCount
                });

                if (this.retryCount < this.maxRetries) {
                    setTimeout(() => this.retry(), 3000);
                } else {
                    this.statusManager.show('error', 'Gagal memuat portal',
                        'Batas percobaan tercapai. Gunakan "Tab Baru"');
                }
            }

            handleLoadTimeout() {
                Logger.error('Iframe load timeout');
                this.handleError();
            }

            handleOnline() {
                this.statusManager.show('success', 'Koneksi tersambung', 'Mencoba memuat ulang...');
                setTimeout(() => this.reload(), 1000);
            }

            handleOffline() {
                this.statusManager.show('error', 'Koneksi terputus', 'Periksa koneksi internet Anda');
            }

            checkIframeHealth() {
                if (this.iframe && this.iframe.src === '') {
                    this.reload();
                }
            }

            reload() {
                if (!this.iframe) return;

                this.retryCount++;
                this.iframe.classList.remove('loaded');
                // Hapus cache buster jika tidak diperlukan
                this.iframe.src = 'https://my.pkp.go.id/cekbantuan';
                this.startLoadMonitor();
            }

            retry() {
                if (this.retryCount <= this.maxRetries) {
                    this.reload();
                }
            }

            static reload() {
                if (window.iframeManager) {
                    window.iframeManager.reload();
                } else {
                    Logger.error('IframeManager instance not available');
                }
            }
        }

        class NavigationManager {
            static openInNewTab(url = 'https://my.pkp.go.id/cekbantuan') {
                try {
                    const newWindow = window.open(url, '_blank', 'noopener,noreferrer');
                    if (!newWindow) {
                        alert('Popup diblokir. Salin dan buka tautan secara manual:\n\n' + url);
                        this.copyToClipboard(url);
                    }
                } catch (err) {
                    Logger.error('Error opening new tab', err);
                    alert('Gagal membuka tab baru. Salin tautan:\n\n' + url);
                }
            }

            static copyToClipboard(text) {
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(text).then(
                        () => Logger.log('URL disalin ke clipboard'),
                        () => Logger.error('Gagal menyalin ke clipboard')
                    );
                }
            }
        }

        class FullscreenManager {
            static toggle() {
                try {
                    if (!document.fullscreenElement) {
                        // Masuk ke mode fullscreen
                        document.documentElement.requestFullscreen().catch(err => {
                            Logger.error('Gagal masuk fullscreen', err);
                            alert('Gagal masuk layar penuh: ' + err.message);
                        });
                    } else {
                        // Keluar dari fullscreen
                        document.exitFullscreen();
                    }
                } catch (error) {
                    Logger.error('Fullscreen not supported or blocked', error);
                    alert('Mode layar penuh tidak didukung atau diblokir oleh browser.');
                }
            }
        }

        window.FullscreenManager = FullscreenManager;

        window.addEventListener('DOMContentLoaded', () => {
            try {
                const eventManager = new EventManager();
                const statusManager = new StatusManager('connection-status');
                const iframeManager = new IframeManager(eventManager, statusManager);
                window.iframeManager = iframeManager;
                Logger.log('Aplikasi Portal PKP siap digunakan');
            } catch (error) {
                Logger.error('Error inisialisasi aplikasi', error);
            }
        });
    </script>
</body>

</html>
