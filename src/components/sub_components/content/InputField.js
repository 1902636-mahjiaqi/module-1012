import React from 'react';

class InputField extends React.Component {
    render() {
        return(
            <div className='inputField'>
                <input className='input form-control' type={this.props.type} placeholder={this.props.placeholder} value={this.props.value}/>
            </div>
        );
    }
}

export default InputField;