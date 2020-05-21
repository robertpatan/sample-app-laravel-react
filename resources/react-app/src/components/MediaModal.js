import React, {Component} from 'react'
import {Button, Image, Modal} from "react-bootstrap";

class MediaModal extends Component {
  state = {
    show: false
  };


  handleClose = () => {
    this.setState({...this.state, ...{show: false}});
  };

  componentDidMount() {
    if (this.props.show) {
      this.setState({...this.state, ...{show: this.props.show}});
    }
  }

  render() {
    let body = null;

    if (this.props.type === 'image') {
      body = (<Image src={this.props.url}/>)
    } else if (this.props.type === 'video') {
      body = (
        <video width="320" height="240" autoPlay>
          <source src={this.props.url} type="video/mp4"/>
        </video>
      )
    }

    return (
      <>
        <Modal show={this.state.show} onHide={this.handleClose}>
          <Modal.Header closeButton>
            <Modal.Title>Modal heading</Modal.Title>
          </Modal.Header>
          <Modal.Body>
            {body && body}
          </Modal.Body>
          <Modal.Footer>
            <Button variant="secondary" onClick={this.handleClose}>
              Close
            </Button>
          </Modal.Footer>
        </Modal>
      </>
    )

  }
}

export default MediaModal;