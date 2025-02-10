interface DisabledProps {
  name: string;
}

/**
 * Disabled Component.
 *
 * This function returns a JSX component that is
 * a disabled input text field.
 *
 * @since 1.0.0
 *
 * @param {Object} props - The component props.
 * @param {DisabledProps} props.message - Default Text value.
 *
 * @returns {JSX.Element}
 */
const Disabled = ( { name }: DisabledProps ): JSX.Element => {
  return (
    <p>
      <input type="text" value={ name } disabled />
    </p>
  );
}

export default Disabled;
