import { useState, useEffect } from '@wordpress/element';
import { useSelect } from '@wordpress/data';

/**
 * Progress Bar Component.
 *
 * This function returns a JSX component that is
 * used to display a Progress Bar.
 *
 * @since 1.2.0
 * @since 1.3.0 Implement Interval logic.
 *
 * @return {JSX.Element} The Progress Bar component.
 */
const ProgressBar = (): JSX.Element => {
	const [ progress, setProgress ] = useState< number >( 0 );
	const { isLoading } = useSelect( ( select ) => {
		const store: any = select( 'sql-to-cpt' );

		return {
			isLoading: store.isLoading(),
		};
	}, [] );

	useEffect( () => {
		let progressInterval: string | number | NodeJS.Timeout;

		if ( isLoading ) {
			setProgress( 0 );
			progressInterval = setInterval( () => {
				setProgress( ( prev ) => ( prev < 90 ? prev + 10 : prev ) );
			}, 500 );
		} else {
			setProgress( 0 );
			clearInterval( progressInterval );
		}

		return () => clearInterval( progressInterval );
	}, [ isLoading ] );

	return (
		<>
			{ isLoading && (
				<div
					data-testid="progress-bar"
					className="sqlt-cpt-progress-bar"
					role="progressbar"
				>
					<div>
						<div style={ { width: `${ progress }%` } } />
					</div>
					<p>{ progress }%</p>
				</div>
			) }
		</>
	);
};

export default ProgressBar;
