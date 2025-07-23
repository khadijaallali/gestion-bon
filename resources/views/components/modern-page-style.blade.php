<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    * {
        font-family: 'Inter', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        margin: 0;
        padding: 20px 0;
    }

    .modern-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 2rem;
        margin: 20px auto;
        max-width: 95%;
        animation: slideIn 0.6s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modern-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(102, 126, 234, 0.2);
    }

    .modern-title {
        color: #2d3748;
        font-weight: 700;
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .brand-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-block;
        margin-bottom: 1rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .modern-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: none;
        margin-bottom: 1.5rem;
    }

    .modern-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border: none;
    }

    .modern-card-title {
        margin: 0;
        font-weight: 600;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modern-card-body {
        padding: 1.5rem;
    }

    .modern-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .modern-list-item {
        background: white;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 12px;
        padding: 1rem 1.5rem;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modern-list-item:hover {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .item-content {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-grow: 1;
    }

    .item-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #667eea;
        font-size: 1.1rem;
    }

    .item-details h5 {
        margin: 0;
        color: #2d3748;
        font-weight: 600;
        font-size: 1rem;
    }

    .item-details p {
        margin: 0;
        color: #718096;
        font-size: 0.9rem;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .modern-btn {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 500;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        text-decoration: none;
    }

    .btn-edit {
        background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        color: #8b4513;
    }

    .btn-edit:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(252, 182, 159, 0.4);
        color: #8b4513;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
        color: #dc3545;
        border: none;
    }

    .btn-delete:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 154, 158, 0.4);
        color: #dc3545;
    }

    .btn-add {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
        margin-bottom: 1.5rem;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
        color: white;
    }

    .modern-alert {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(72, 187, 120, 0.1) 0%, rgba(56, 178, 172, 0.1) 100%);
        color: #38a169;
        border-left: 4px solid #38a169;
    }

    .alert-warning {
        background: linear-gradient(135deg, rgba(237, 137, 54, 0.1) 0%, rgba(245, 158, 11, 0.1) 100%);
        color: #d69e2e;
        border-left: 4px solid #d69e2e;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: #718096;
    }

    .empty-state i {
        font-size: 3rem;
        color: #cbd5e0;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        color: #4a5568;
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .modern-container {
            margin: 10px;
            padding: 1.5rem;
        }
        
        .modern-title {
            font-size: 1.8rem;
        }
        
        .modern-list-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .action-buttons {
            width: 100%;
            justify-content: flex-end;
        }
    }
</style>
