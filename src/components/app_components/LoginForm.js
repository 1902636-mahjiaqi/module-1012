import React from 'react';
import InputField from '../sub_components/content/InputField';
import SubmitButton from '../sub_components/content/SubmitButton';

class LoginForm extends React.Component {
    render() {
        return(
            <div class="container-fluid">
                <div class="row justify-content-center">
                <div class="col-xl-3 jumbotron bg-white">
                        <div className='loginForm'>
                        <div className="form-group">
                            <h4>Login Page</h4>
                        </div>
                        <div className="form-group">
                            <label for="username">Username </label>
                            <InputField type='text' placeholder='Username'/>
                        </div>
                        <div className="form-group">
                            <label for="password">Password </label>
                            <InputField type='text' placeholder='Password'/>
                        </div>
                        <SubmitButton text='Login'/>
                    </div>
                </div>
                </div>
            </div>
        );
    }
}

export default LoginForm;