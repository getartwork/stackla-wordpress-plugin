(function()
{
    'use strict';

    window.stacklaWp.admin.components.Filter = React.createClass(
    {
        propTypes:
        {
            key:React.PropTypes.number,
            id:React.PropTypes.number,
        },
        getInitialState:function()
        {
            return {
                id:this.props.id,
                name:'',
                network:[],
                media:[],
                sorting:'latest',
                errors:false
            }
        },
        handleNameChange:function(e)
        {
            this.setState({name:e.target.value});
        },
        handleNetworkCheck:function(e)
        {
            var copy = this.state.network.slice();
            var index = copy.indexOf(e.target.value);

            if(e.target.checked === true)
            {
                if(index <= -1)
                {
                    copy.push(e.target.value);

                    this.setState(
                    {
                        network:copy
                    });
                }
            }
            else
            {
                if(index > -1)
                {
                    copy.splice(index , 1);

                    this.setState(
                    {
                        network:copy
                    });
                }
            }


        },
        handleMediaCheck:function(e)
        {
            var copy = this.state.media.slice();
            var index = copy.indexOf(e.target.value);

            if(e.target.checked === true)
            {
                if(index <= -1)
                {
                    copy.push(e.target.value);

                    this.setState(
                    {
                        media:copy
                    });
                }
            }
            else
            {
                if(index > -1)
                {
                    copy.splice(index , 1);

                    this.setState(
                    {
                        media:copy
                    });
                }
            }
        },
        handleSortingChange:function(e)
        {
            this.setState({sorting:e.target.value});
        },
        render:function()
        {
            console.log(this.state.network);
            return (
                <div className='stackla-block'>
                    <div className={(this.state.errors === false) ? 'stackla-widget-section' : 'stackla-widget-section stackla-widget-error'}>
                        <fieldset className='term-name'>
                            <label>
                                Filter name
                            </label>
                            <input type='text' className='widefat' onChange={this.handleNameChange}/>
                        </fieldset>
                        <fieldset>
                            <label>
                                Network
                            </label>
                            <fieldset>
                                <input type='checkbox' value='twitter' onChange={this.handleNetworkCheck}/>
                                <label className='checkbox'>
                                    Twitter
                                </label>
                            </fieldset>
                            <fieldset>
                                <input type='checkbox' value='facebook' onChange={this.handleNetworkCheck}/>
                                <label className='checkbox'>
                                    Facebook
                                </label>
                            </fieldset>
                            <fieldset>
                                <input type='checkbox' value='instagram' onChange={this.handleNetworkCheck}/>
                                <label className='checkbox'>
                                    Instagram
                                </label>
                            </fieldset>
                            <fieldset>
                                <input type='checkbox' value='youtube' onChange={this.handleNetworkCheck}/>
                                <label className='checkbox'>
                                    YouTube
                                </label>
                            </fieldset>
                        </fieldset>
                         <fieldset>
                            <label>
                                Media
                            </label>
                            <fieldset>
                                <input type='checkbox' value='text-only' onChange={this.handleMediaCheck}/>
                                <label className='checkbox'>
                                    Text-only
                                </label>
                            </fieldset>
                            <fieldset>
                                <input type='checkbox' value='images' onChange={this.handleMediaCheck}/>
                                <label className='checkbox'>
                                    Images
                                </label>
                            </fieldset>
                            <fieldset>
                                <input type='checkbox' value='video' onChange={this.handleMediaCheck}/>
                                <label className='checkbox'>
                                    Video
                                </label>
                            </fieldset>
                         </fieldset>
                         <fieldset>
                            <label>
                                Sorting
                            </label>
                            <select value={this.state.sorting} onChange={this.handleSortingChange}>
                                <option value='latest'>
                                    Latest
                                </option>
                                <option value='greatest'>
                                    Greatest
                                </option>
                                <option value='votes'>
                                    Votes
                                </option>
                            </select>
                         </fieldset>
                     </div>
                     <div className={(this.state.errors === false) ? 'hide' : 'stackla-error-message'}>
                        <ul>
                            <li className={(this.state.errors.name) ? '' : 'hide'}>
                                {(this.state.errors.name) ? this.state.errors.name : ''}
                            </li>
                            <li className={(this.state.errors.media) ? '' : 'hide'}>
                                {(this.state.errors.media) ? this.state.errors.media : ''}
                            </li>
                            <li className={(this.state.errors.network) ? '' : 'hide'}>
                                {(this.state.errors.network) ? this.state.errors.network : ''}
                            </li>
                            <li className={(this.state.errors.sorting) ? '' : 'hide'}>
                                {(this.state.errors.sorting) ? this.state.errors.sorting : ''}
                            </li>
                        </ul>
                     </div>
                 </div>
            );
        }
    });
}());