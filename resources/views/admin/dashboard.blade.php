<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tableau de bord - AutoPart Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eceff1;
            height: 100%;
            overflow: hidden;
        }

        .dashboard-wrapper {
            display: flex;
            flex-direction: row;
            height: 100vh;
            background-color: #eceff1;
        }

        /* ===== SIDEBAR STYLES ===== */
        .sidebar {
            width: 220px;
            background: linear-gradient(180deg, #465a6d 0%, #3a4f5e 100%);
            color: white;
            overflow-y: auto;
            padding-top: 0;
            border-right: 1px solid #2a3a4e;
            flex-shrink: 0;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar-section {
            padding: 4px 0;
            margin: 12px 0;
        }

        .sidebar-section:first-child {
            margin-top: 0;
        }

        .sidebar-title {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            color: #8b95a4;
            padding: 12px 16px 8px 16px;
            letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar-link {
            display: block;
            width: 100%;
            padding: 10px 16px;
            font-size: 12px;
            color: #d0d6dc;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            border: none;
            background: none;
            text-align: left;
            font-family: inherit;
        }

        .sidebar-link:hover:not(:disabled) {
            background-color: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            border-left-color: #7a92a4;
        }

        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-left-color: #a8c5d8;
        }

        .sidebar-link:disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }

        .sidebar-icon {
            display: inline-block;
            width: 14px;
            margin-right: 8px;
            text-align: center;
        }

        /* ===== CONTENT AREA ===== */
        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #eceff1;
        }

        /* ===== BREADCRUMB BAR ===== */
        .breadcrumb-bar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .breadcrumb-content {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .breadcrumb-home {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 18px;
            color: #465a6d;
            padding: 4px 8px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .breadcrumb-home:hover {
            background-color: #f0f0f0;
            color: #2a3a4e;
        }

        .breadcrumb-separator {
            color: #bbb;
            margin: 0 4px;
        }

        .breadcrumb-title {
            color: #465a6d;
            font-weight: 600;
        }

        /* ===== MODULE CONTENT ===== */
        #module-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        /* ===== DASHBOARD CARDS ===== */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .dashboard-card {
            background: linear-gradient(135deg, #546b7a 0%, #465a6d 100%);
            border: none;
            border-radius: 8px;
            padding: 20px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
            background: linear-gradient(135deg, #5d7c8f 0%, #4d6a7e 100%);
        }

        .card-icon {
            font-size: 32px;
            margin-bottom: 12px;
            opacity: 0.95;
        }

        .card-title {
            font-size: 12px;
            font-weight: 600;
            line-height: 1.4;
            letter-spacing: 0.3px;
        }

        /* ===== FORMS & CONTENT ===== */
        .form-container {
            background: white;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            max-width: 1200px;
            margin: 0 auto;
        }

        .form-tabs {
            display: flex;
            gap: 0;
            margin-bottom: 24px;
            border-bottom: 2px solid #e0e0e0;
        }

        .form-tab {
            background: none;
            border: none;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            transition: all 0.2s ease;
            margin-bottom: -2px;
        }

        .form-tab:hover {
            color: #465a6d;
        }

        .form-tab.active {
            color: #465a6d;
            border-bottom-color: #465a6d;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
            font-size: 13px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 13px;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #465a6d;
            box-shadow: 0 0 0 2px rgba(70, 90, 109, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .form-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #e0e0e0;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: #465a6d;
            color: white;
        }

        .btn-primary:hover {
            background-color: #3a4f5e;
        }

        .btn-secondary {
            background-color: #e0e0e0;
            color: #333;
        }

        .btn-secondary:hover {
            background-color: #d0d0d0;
        }

        /* ===== LOADING SPINNER ===== */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
        }

        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #465a6d;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1400px) {
            .card-grid {
                grid-template-columns: repeat(5, 1fr);
            }
        }

        @media (max-width: 1024px) {
            .card-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                max-height: 150px;
                border-right: none;
                border-bottom: 1px solid #2a3a4e;
                overflow-x: auto;
                overflow-y: hidden;
                display: flex;
            }

            .sidebar-section {
                flex-shrink: 0;
                margin: 0;
                padding-right: 24px;
            }

            .card-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 480px) {
            .card-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- ===== SIDEBAR ===== -->
        <div class="sidebar">
            <!-- 📦 STOCK -->
            <div class="sidebar-section">
                <div class="sidebar-title">📦 Stock</div>
                <button class="sidebar-link module-link" data-module="articles" data-title="Articles">
                    <span class="sidebar-icon"><i class="fas fa-list"></i></span>
                    Articles
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-link"></i></span>
                    Références
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-boxes"></i></span>
                    Inventaire
                </button>
            </div>

            <!-- 🚚 VENTES / ACHATS (DOCUMENTS) -->
            <div class="sidebar-section">
                <div class="sidebar-title">🚚 Documents</div>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-box"></i></span>
                    List bons livraison
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-shopping-cart"></i></span>
                    List bons Commandes
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-shopping-cart"></i></span>
                    List Bon Achat
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-receipt"></i></span>
                    List des Factures
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-file"></i></span>
                    Facture
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-file"></i></span>
                    Facture achat
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-arrow-left"></i></span>
                    List bons retour
                </button>
            </div>

            <!-- ↩️ AVOIRS -->
            <div class="sidebar-section">
                <div class="sidebar-title">↩️ Avoirs</div>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-clipboard"></i></span>
                    List Avoir clients
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-clipboard"></i></span>
                    Avoir Fournisseurs
                </button>
            </div>

            <!-- 💰 RÈGLEMENTS -->
            <div class="sidebar-section">
                <div class="sidebar-title">💰 Règlements</div>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-money-bill"></i></span>
                    Reglement clients
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-money-bill"></i></span>
                    Reglement Fournisseur
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-money-bill"></i></span>
                    Reglement FC
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-money-bill"></i></span>
                    Reglements Factures
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-piggy-bank"></i></span>
                    Bank
                </button>
            </div>

            <!-- 👥 PARTENAIRES -->
            <div class="sidebar-section">
                <div class="sidebar-title">👥 Partenaires</div>
                <button class="sidebar-link module-link" data-module="clients" data-title="Clients">
                    <span class="sidebar-icon"><i class="fas fa-users"></i></span>
                    Clients
                </button>
                <button class="sidebar-link module-link" data-module="suppliers" data-title="Fournisseurs">
                    <span class="sidebar-icon"><i class="fas fa-truck"></i></span>
                    Fournisseurs
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-user-tie"></i></span>
                    List des commerciaux
                </button>
                <button class="sidebar-link module-link" data-module="representants" data-title="Representants">
                    <span class="sidebar-icon"><i class="fas fa-users"></i></span>
                    Representants
                </button>
            </div>

            <!-- 📊 SUIVI / ÉTATS -->
            <div class="sidebar-section">
                <div class="sidebar-title">📊 Suivi</div>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-clock"></i></span>
                    Echeances
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-user"></i></span>
                    Situation Client
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-users"></i></span>
                    Situation Fournisseurs
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-clipboard"></i></span>
                    Etat BL
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-file"></i></span>
                    Etat BL/FC
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-user"></i></span>
                    Etat Client FC
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-chart-bar"></i></span>
                    Reliquat
                </button>
            </div>

            <!-- 📈 JOURNAUX & RAPPORTS -->
            <div class="sidebar-section">
                <div class="sidebar-title">📈 Journaux</div>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-arrow-up-down"></i></span>
                    Journal ventes
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-arrow-up-down"></i></span>
                    Journal Achat
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-arrow-up-down"></i></span>
                    Journal Vente FC
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-arrow-up-down"></i></span>
                    Journal Achat FC
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-chart-bar"></i></span>
                    Rapport
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-pen"></i></span>
                    Etude
                </button>
            </div>

            <!-- 📚 CATALOGUE -->
            <div class="sidebar-section">
                <div class="sidebar-title">📚 Catalogue</div>
                <button class="sidebar-link module-link" data-module="catalog" data-title="Catalog">
                    <span class="sidebar-icon"><i class="fas fa-th"></i></span>
                    Catalog
                </button>
                <button class="sidebar-link module-link" data-module="categories" data-title="Catégories">
                    <span class="sidebar-icon"><i class="fas fa-tags"></i></span>
                    Categories
                </button>
                <button class="sidebar-link module-link" data-module="brands" data-title="Marques">
                    <span class="sidebar-icon"><i class="fas fa-star"></i></span>
                    Marques
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-gift"></i></span>
                    Promotions
                </button>
            </div>

            <!-- ⚙️ SYSTÈME -->
            <div class="sidebar-section">
                <div class="sidebar-title">⚙️ Système</div>
                <button class="sidebar-link module-link" data-module="sales-logo" data-title="Logo Ventes">
                    <span class="sidebar-icon"><i class="fas fa-cog"></i></span>
                    Logo ventes
                </button>
                <button class="sidebar-link" disabled>
                    <span class="sidebar-icon"><i class="fas fa-link"></i></span>
                    Connecté
                </button>
            </div>
        </div>

        <!-- ===== CONTENT AREA ===== -->
        <div class="content-area">
            <!-- ===== BREADCRUMB BAR ===== -->
            <div class="breadcrumb-bar">
                <div class="breadcrumb-content">
                    <button class="breadcrumb-home" id="homeBtn" title="Retour au tableau de bord">
                        <i class="fas fa-home"></i>
                    </button>
                    <span class="breadcrumb-separator" id="separatorDisplay">/</span>
                    <span class="breadcrumb-title" id="breadcrumbTitle">Accueil</span>
                </div>
            </div>

            <!-- ===== DYNAMIC MODULE CONTENT ===== -->
            <div id="module-content"></div>
        </div>
    </div>

    <script>
        const app = {
            currentModule: null,

            init() {
                this.showDashboardCards();
                this.setupEventListeners();
            },

            setupEventListeners() {
                // Home button - returns to dashboard
                document.getElementById('homeBtn').addEventListener('click', () => this.showDashboardCards());

                // Sidebar module links
                document.querySelectorAll('.module-link').forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        const module = e.currentTarget.dataset.module;
                        const title = e.currentTarget.dataset.title;
                        this.loadModule(module, title);
                    });
                });

                // Dashboard cards
                document.querySelectorAll('.dashboard-card').forEach(card => {
                    card.addEventListener('click', (e) => {
                        const module = e.currentTarget.dataset.module;
                        const action = e.currentTarget.dataset.action;
                        
                        if (module) {
                            const sectionMap = {
                                'articles': 'Articles',
                                'clients': 'Clients',
                                'representants': 'Representants',
                                'suppliers': 'Fournisseurs',
                                'categories': 'Catégories',
                                'brands': 'Marques'
                            };
                            
                            if (action === 'list') {
                                this.getModuleList(module, sectionMap[module]);
                            } else {
                                this.loadModule(module, sectionMap[module]);
                            }
                        }
                    });
                });
            },

            showDashboardCards() {
                this.currentModule = null;
                const content = document.getElementById('module-content');

                // Update breadcrumb - ONLY show home
                document.getElementById('breadcrumbTitle').textContent = 'Accueil';
                document.getElementById('separatorDisplay').style.display = 'none';

                // Clear active state from sidebar
                document.querySelectorAll('.module-link').forEach(link => link.classList.remove('active'));

                // Display dashboard cards
                content.innerHTML = `
                    <!-- ROW 1 -->
                    <div class="card-grid">
                        <button class="dashboard-card" data-module="articles" data-action="list">
                            <div class="card-icon"><i class="fas fa-list"></i></div>
                            <div class="card-title">Articles</div>
                        </button>
                        <button class="dashboard-card" data-module="clients" data-action="list">
                            <div class="card-icon"><i class="fas fa-users"></i></div>
                            <div class="card-title">CLIENTS</div>
                        </button>
                        <button class="dashboard-card" data-module="suppliers" data-action="list">
                            <div class="card-icon"><i class="fas fa-users"></i></div>
                            <div class="card-title">Fournisseur</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-money-bill"></i></div>
                            <div class="card-title">Reglements</div>
                        </button>
                        <button class="dashboard-card" data-module="representants" data-action="list">
                            <div class="card-icon"><i class="fas fa-users"></i></div>
                            <div class="card-title">Representants</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-shopping-cart"></i></div>
                            <div class="card-title">Panier</div>
                        </button>
                    </div>

                    <!-- ROW 2 -->
                    <div class="card-grid">
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-box"></i></div>
                            <div class="card-title">List Bon livraison</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-shopping-cart"></i></div>
                            <div class="card-title">List Bon commande</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-shopping-cart"></i></div>
                            <div class="card-title">List Bon Achat</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-clipboard"></i></div>
                            <div class="card-title">List Avoir client</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-clipboard"></i></div>
                            <div class="card-title">List Avoir Fournisseur</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-chart-bar"></i></div>
                            <div class="card-title">Reliquat</div>
                        </button>
                    </div>

                    <!-- ROW 3 -->
                    <div class="card-grid">
                        <button class="dashboard-card" data-module="articles" data-action="add">
                            <div class="card-icon"><i class="fas fa-plus"></i></div>
                            <div class="card-title">Article +</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-plus"></i></div>
                            <div class="card-title">Bon Livraison +</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-plus"></i></div>
                            <div class="card-title">Avoir Client +</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-plus"></i></div>
                            <div class="card-title">Bon Achat +</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-link"></i></div>
                            <div class="card-title">Connecter</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-clock"></i></div>
                            <div class="card-title">Echeances</div>
                        </button>
                    </div>

                    <!-- ROW 4 -->
                    <div class="card-grid">
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-user"></i></div>
                            <div class="card-title">Situation Client</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-arrow-up-down"></i></div>
                            <div class="card-title">Journal Achat</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-arrow-up-down"></i></div>
                            <div class="card-title">Journal ventes</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-users"></i></div>
                            <div class="card-title">Situation Fournisseurs</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-money-bill"></i></div>
                            <div class="card-title">Reglements Fournisseurs</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-clipboard"></i></div>
                            <div class="card-title">Etat bl</div>
                        </button>
                    </div>

                    <!-- ROW 5 -->
                    <div class="card-grid">
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-chart-bar"></i></div>
                            <div class="card-title">Rapport</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-pen"></i></div>
                            <div class="card-title">Etude</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-file"></i></div>
                            <div class="card-title">Etat BL/FC</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-money-bill"></i></div>
                            <div class="card-title">Bank</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-receipt"></i></div>
                            <div class="card-title">Facture achat</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-boxes"></i></div>
                            <div class="card-title">INVENTAIRE</div>
                        </button>
                    </div>

                    <!-- ROW 6 -->
                    <div class="card-grid">
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-receipt"></i></div>
                            <div class="card-title">List Factures</div>
                        </button>
                        <button class="dashboard-card" data-module="articles" data-action="add">
                            <div class="card-icon"><i class="fas fa-plus"></i></div>
                            <div class="card-title">Facture +</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-money-bill"></i></div>
                            <div class="card-title">Reglements Factures</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-arrow-up-down"></i></div>
                            <div class="card-title">Journal Vente FC</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-arrow-up-down"></i></div>
                            <div class="card-title">Journal Achat FC</div>
                        </button>
                        <button class="dashboard-card">
                            <div class="card-icon"><i class="fas fa-user"></i></div>
                            <div class="card-title">Etat Client FC</div>
                        </button>
                    </div>
                `;

                this.setupEventListeners();
            },

            async loadModule(module, sectionTitle) {
                // Replace current module (not stack)
                this.currentModule = module;
                const content = document.getElementById('module-content');

                // Update breadcrumb to show ONLY current section (no stacking)
                document.getElementById('breadcrumbTitle').textContent = sectionTitle;
                document.getElementById('separatorDisplay').style.display = 'inline';

                // Show loading spinner
                content.innerHTML = '<div class="loading"><div class="spinner"></div></div>';

                try {
                    const response = await fetch(`/admin/modules/${module}/form`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) throw new Error(`HTTP ${response.status}`);

                    const data = await response.json();
                    content.innerHTML = data.html || '<p>Contenu non disponible</p>';

                    // Update sidebar active state
                    document.querySelectorAll('.module-link').forEach(link => {
                        link.classList.remove('active');
                        if (link.dataset.module === module) {
                            link.classList.add('active');
                        }
                    });

                    // Re-attach event listeners for any new interactive elements
                    this.setupEventListeners();
                } catch (error) {
                    console.error('Error loading module:', error);
                    content.innerHTML = '<p style="color: red;">Erreur lors du chargement du contenu</p>';
                }
            },

            async getModuleList(module, sectionTitle) {
                this.currentModule = module;
                const content = document.getElementById('module-content');

                // Update breadcrumb
                document.getElementById('breadcrumbTitle').textContent = sectionTitle || module;
                document.getElementById('separatorDisplay').style.display = 'inline';

                // Show loading spinner
                content.innerHTML = '<div class="loading"><div class="spinner"></div></div>';

                try {
                    const response = await fetch(`/admin/modules/${module}/list`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    if (!response.ok) throw new Error(`HTTP ${response.status}`);

                    const data = await response.json();
                    content.innerHTML = data.html || '<p>Aucun élément trouvé</p>';

                    // Update sidebar active state
                    document.querySelectorAll('.module-link').forEach(link => {
                        link.classList.remove('active');
                        if (link.dataset.module === module) {
                            link.classList.add('active');
                        }
                    });

                    this.setupEventListeners();
                } catch (error) {
                    console.error('Error loading list:', error);
                    content.innerHTML = '<p style="color: red;">Erreur lors du chargement</p>';
                }
            }
        };

        document.addEventListener('DOMContentLoaded', () => app.init());
    </script>
</body>
</html>
