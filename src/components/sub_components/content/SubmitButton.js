import React from 'react';

class SubmitButton extends React.Component {
    render() {
        return(
            <div className='submitButton'>
                <button className='btnSubmit btn btn-danger btn-block' disabled={this.props.disabled} onClick={ () => this.props.onClick() }> {this.props.text} </button>
            </div>
        );
    }
}

export default SubmitButton;