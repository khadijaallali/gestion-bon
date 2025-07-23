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

    .modern-form-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 2rem;
        margin: 20px auto;
        max-width: 600px;
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

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid rgba(102, 126, 234, 0.2);
    }

    .form-title {
        color: #2d3748;
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .form-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .modern-form {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        color: #2d3748;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-control-modern {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        color: #2d3748;
    }

    .form-control-modern:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        transform: translateY(-1px);
    }

    .form-control-modern::placeholder {
        color: #a0aec0;
    }

    .form-buttons {
        display: flex;
        gap: 12px;
        justify-content: center;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .btn-modern {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        min-width: 120px;
        justify-content: center;
    }

    .btn-primary-modern {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
    }

    .btn-primary-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 172, 254, 0.4);
        color: white;
    }

    .btn-secondary-modern {
        background: rgba(0, 0, 0, 0.1);
        color: #4a5568;
        border: 1px solid rgba(0, 0, 0, 0.2);
    }

    .btn-secondary-modern:hover {
        background: rgba(0, 0, 0, 0.15);
        transform: translateY(-1px);
        color: #2d3748;
    }

    .modern-alert {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .alert-danger-modern {
        background: linear-gradient(135deg, rgba(245, 101, 101, 0.1) 0%, rgba(229, 62, 62, 0.1) 100%);
        color: #e53e3e;
        border-left: 4px solid #e53e3e;
    }

    .alert-danger-modern ul {
        margin: 0;
        padding-left: 1rem;
    }

    .alert-danger-modern li {
        margin-bottom: 0.25rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .back-link:hover {
        color: #764ba2;
        transform: translateX(-3px);
    }

    @media (max-width: 768px) {
        .modern-form-container {
            margin: 10px;
            padding: 1.5rem;
        }
        
        .form-title {
            font-size: 1.6rem;
            flex-direction: column;
        }
        
        .modern-form {
            padding: 1.5rem;
        }
        
        .form-buttons {
            flex-direction: column;
        }
        
        .btn-modern {
            width: 100%;
        }
    }

    .form-select-modern {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        color: #2d3748;
        cursor: pointer;
    }

    .form-select-modern:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        transform: translateY(-1px);
    }

    .form-textarea-modern {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        color: #2d3748;
        resize: vertical;
        min-height: 100px;
    }

    .form-textarea-modern:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        transform: translateY(-1px);
    }
</style>
