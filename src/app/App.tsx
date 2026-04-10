import {
	ImportButton,
	Notice,
	ProgressBar,
	Purge,
	TableName,
	TableColumns,
} from '../components/All';
import '../store';
import '../styles/app.scss';

const App = (): JSX.Element => {
	return (
		<main>
			<section>
				<ImportButton />
				<Purge />
			</section>

			<Notice />
			<ProgressBar />
			<TableName />
			<TableColumns />
		</main>
	);
};

export default App;
